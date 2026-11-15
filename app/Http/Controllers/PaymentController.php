<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Services\MidtransService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected MidtransService $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    /**
     * Create order & generate Midtrans Snap Token
     */
    public function createSnapToken(Request $request): JsonResponse
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:30',
            'shipping_address' => 'required|string',
            'courier' => 'nullable|string|max:50',
            'shipping_cost' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|integer',
            'items.*.product_name' => 'required|string',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $subtotal = 0;
            $itemDetails = [];

            foreach ($request->items as $item) {
                $subtotal += ($item['price'] * $item['quantity']);
                $itemDetails[] = [
                    'id' => (string) ($item['product_id'] ?? Str::slug($item['product_name'])),
                    'price' => (int) round($item['price']),
                    'quantity' => (int) $item['quantity'],
                    'name' => mb_substr($item['product_name'], 0, 50),
                ];
            }

            $shippingCost = (float) ($request->shipping_cost ?? 0);
            if ($shippingCost > 0) {
                $itemDetails[] = [
                    'id' => 'shipping_fee',
                    'price' => (int) round($shippingCost),
                    'quantity' => 1,
                    'name' => 'Ongkos Kirim (' . ($request->courier ?? 'Kurir') . ')',
                ];
            }

            $discount = (float) ($request->discount ?? 0);
            if ($discount > 0) {
                $itemDetails[] = [
                    'id' => 'voucher_discount',
                    'price' => (int) -round($discount),
                    'quantity' => 1,
                    'name' => 'Diskon Promo',
                ];
            }

            $totalAmount = max(1, $subtotal + $shippingCost - $discount);

            // Generate unique Order Number
            $orderNumber = 'ZRB-' . strtoupper(Str::random(4)) . '-' . date('ymdHis');

            $userId = Auth::id();
            if (!$userId && !empty($request->customer_email)) {
                $userByEmail = \App\Models\User::where('email', $request->customer_email)->first();
                if ($userByEmail) {
                    $userId = $userByEmail->id;
                }
            }

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $userId,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'courier' => $request->courier,
                'shipping_cost' => $shippingCost,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total_amount' => $totalAmount,
                'notes' => $request->notes,
                'status' => 'pending',
            ]);

            foreach ($request->items as $item) {
                $prodCode = $item['product_code'] ?? null;
                $prodImage = $item['product_image'] ?? null;
                if (!empty($item['product_id'])) {
                    $prodObj = Product::find($item['product_id']);
                    if ($prodObj) {
                        $prodCode = $prodObj->code;
                        $prodImage = $prodObj->main_image;
                    }
                }
                if (!$prodCode) {
                    $prodCode = 'ZRB-' . strtoupper(Str::random(6));
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? null,
                    'product_code' => $prodCode,
                    'product_name' => $item['product_name'],
                    'product_image' => $prodImage,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'size' => $item['size'] ?? 'All Size',
                    'notes' => $item['notes'] ?? null,
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            // Filter enabled payment method from user selection
            $method = strtolower($request->input('payment_method', ''));
            $channel = strtolower($request->input('payment_channel', ''));

            // Tentukan label metode pembayaran yang ramah pengguna
            $displayPaymentMethod = 'QRIS';
            if ($method === 'transfer') {
                $displayPaymentMethod = 'Bank Transfer - ' . strtoupper($channel ?: 'BCA');
            } elseif ($method === 'ewallet') {
                $displayPaymentMethod = 'E-Wallet - ' . ucfirst($channel ?: 'GoPay');
            } elseif ($method === 'qris') {
                $displayPaymentMethod = 'QRIS';
            }

            // Create initial Payment record dengan metode yang dipilih user
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $displayPaymentMethod,
                'payment_channel' => $channel ?: null,
                'amount' => $totalAmount,
                'payment_status' => 'unpaid',
            ]);

            // Snap Payload
            $params = [
                'transaction_details' => [
                    'order_id' => $orderNumber,
                    'gross_amount' => (int) round($totalAmount),
                ],
                'customer_details' => [
                    'first_name' => $request->customer_name,
                    'email' => $request->customer_email,
                    'phone' => $request->customer_phone,
                    'shipping_address' => [
                        'first_name' => $request->customer_name,
                        'phone' => $request->customer_phone,
                        'address' => $request->shipping_address,
                    ],
                ],
                'item_details' => $itemDetails,
            ];

            // Filter enabled payment method from user selection
            $method = strtolower($request->input('payment_method', ''));
            $channel = strtolower($request->input('payment_channel', ''));

            if ($method === 'qris') {
                // Berikan opsi qris bersama gopay & shopeepay sebagai fallback jika QRIS merchant belum diapprove
                $params['enabled_payments'] = ['qris', 'gopay', 'shopeepay'];
            } elseif ($method === 'transfer') {
                if ($channel === 'bca') {
                    $params['enabled_payments'] = ['bca_va', 'bank_transfer', 'other_va'];
                } elseif ($channel === 'bni') {
                    $params['enabled_payments'] = ['bni_va', 'bank_transfer', 'other_va'];
                } elseif ($channel === 'bri') {
                    $params['enabled_payments'] = ['bri_va', 'bank_transfer', 'other_va'];
                } elseif ($channel === 'mandiri') {
                    $params['enabled_payments'] = ['echannel', 'bank_transfer'];
                } else {
                    $params['enabled_payments'] = ['bank_transfer', 'bca_va', 'bni_va', 'bri_va', 'echannel', 'other_va'];
                }
            } elseif ($method === 'ewallet') {
                if (str_contains($channel, 'gopay')) {
                    $params['enabled_payments'] = ['gopay', 'qris'];
                } elseif (str_contains($channel, 'shopee')) {
                    $params['enabled_payments'] = ['shopeepay', 'qris'];
                } else {
                    $params['enabled_payments'] = ['gopay', 'shopeepay', 'qris'];
                }
            }

            $snapToken = $this->midtrans->createSnapToken($params);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'order_number' => $orderNumber,
                'snap_token' => $snapToken,
                'redirect_url' => route('order.success') . '?order=' . $orderNumber,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Create Snap Token Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyiapkan pembayaran: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle Midtrans Webhook / Callback Notification
     */
    public function handleNotification(Request $request): JsonResponse
    {
        $payload = $request->all();
        Log::info('Midtrans Webhook Received: ', $payload);

        $orderNumber = $payload['order_id'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;
        $paymentType = $payload['payment_type'] ?? 'midtrans';

        if (!$orderNumber) {
            return response()->json(['message' => 'Order ID required'], 400);
        }

        // Verify SHA512 signature
        $serverKey = config('services.midtrans.server_key', env('MIDTRANS_SERVER_KEY', ''));
        $expectedSignature = hash('sha512', $orderNumber . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $expectedSignature) {
            Log::warning('Invalid signature Midtrans Webhook', [
                'expected' => $expectedSignature,
                'received' => $signatureKey,
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('order_number', $orderNumber)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $payment = Payment::firstOrNew(['order_id' => $order->id]);
        $payment->payment_method = $paymentType;
        $payment->payment_channel = $payload['bank'] ?? $payload['channel'] ?? $paymentType;
        $payment->amount = (float) $grossAmount;

        $wasPending = $order->status !== 'paid'; // track if this is the first time being marked paid

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $order->status = 'paid';
                $payment->payment_status = 'paid';
                $payment->paid_at = now();
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->status = 'paid';
            $payment->payment_status = 'paid';
            $payment->paid_at = now();
        } elseif (in_array($transactionStatus, ['pending'])) {
            $order->status = 'pending';
            $payment->payment_status = 'unpaid';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $order->status = 'cancelled';
            $payment->payment_status = 'failed';
        }

        $order->save();
        $payment->save();

        // Reduce stock when payment is successful (only once)
        if ($wasPending && $order->status === 'paid') {
            foreach ($order->items as $orderItem) {
                if ($orderItem->product_id) {
                    $product = Product::find($orderItem->product_id);
                    if ($product && $product->stock >= $orderItem->quantity) {
                        $product->decrement('stock', $orderItem->quantity);
                    }
                }
            }
        }

        return response()->json(['message' => 'Notification handled successfully']);
    }

    /**
     * Frontend check order status update after Snap closes
     */
    public function finishPayment(Request $request): JsonResponse
    {
        $orderNumber = $request->query('order_number');
        if (!$orderNumber) {
            return response()->json(['status' => 'error', 'message' => 'Order number missing'], 400);
        }

        $order = Order::where('order_number', $orderNumber)->first();
        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        // Mark as paid if user succeeded via Snap popup
        if ($request->input('result_status') === 'success' || $request->input('result_status') === 'settlement') {
            $wasPending = $order->status !== 'paid';
            $order->update(['status' => 'paid']);
            $existingPayment = Payment::where('order_id', $order->id)->first();
            $paymentMethod = $existingPayment && !empty($existingPayment->payment_method) && $existingPayment->payment_method !== 'midtrans'
                ? $existingPayment->payment_method
                : strtoupper($request->input('payment_type', 'QRIS'));

            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'payment_method' => $paymentMethod,
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                    'amount' => $order->total_amount,
                ]
            );

            // Reduce stock when payment confirmed (only once)
            if ($wasPending) {
                foreach ($order->items as $orderItem) {
                    if ($orderItem->product_id) {
                        $product = Product::find($orderItem->product_id);
                        if ($product && $product->stock >= $orderItem->quantity) {
                            $product->decrement('stock', $orderItem->quantity);
                        }
                    }
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'order_status' => $order->status,
            'redirect' => route('order.success') . '?order=' . $order->order_number,
        ]);
    }
}

