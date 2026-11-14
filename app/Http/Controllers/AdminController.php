<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display the Admin Dashboard
     */
    public function dashboard()
    {
        $today = now()->toDateString();
        $todaySales = Order::whereDate('created_at', $today)->where('status', '!=', 'cancelled')->sum('total_amount');
        $todayOrders = Order::whereDate('created_at', $today)->count();
        $todaySold = OrderItem::whereHas('order', fn($q) => $q->whereDate('created_at', $today))->sum('quantity');
        $todayNewCustomers = User::where('role', 'customer')->whereDate('created_at', $today)->count();

        $topProducts = OrderItem::select('product_id', 'product_name', 'product_image', DB::raw('SUM(subtotal) as revenue'), DB::raw('SUM(quantity) as units_sold'))
            ->groupBy('product_id', 'product_name', 'product_image')
            ->orderByDesc('units_sold')
            ->limit(6)
            ->get();
        $maxUnits = $topProducts->max('units_sold') ?: 1;

        $topCustomers = Order::select('user_id', 'customer_name', DB::raw('SUM(total_amount) as total_purchases'))
            ->where('status', '!=', 'cancelled')
            ->groupBy('user_id', 'customer_name')
            ->orderByDesc('total_purchases')
            ->limit(6)
            ->get();
        // Eager load user untuk avatar
        $userIds = $topCustomers->pluck('user_id')->filter()->unique();
        $users = User::whereIn('id', $userIds)->get()->keyBy('id');
        $topCustomers->each(function($c) use ($users) {
            $c->userObj = $users->get($c->user_id);
        });
        $maxPurchases = $topCustomers->max('total_purchases') ?: 1;

        return view('admin.dashboard', compact('todaySales','todayOrders','todaySold','todayNewCustomers','topProducts','maxUnits','topCustomers','maxPurchases'));
    }

    /**
     * Display Sales Report
     */
    public function salesReport()
    {
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $totalOrders = Order::count();
        $newCustomers = User::where('role', 'customer')->count();

        // Financial Wallets by Payment method
        $bankTotal = Order::where('status', '!=', 'cancelled')
            ->whereHas('payment', function($q) {
                $q->where('payment_method', 'like', '%bank%')
                  ->orWhere('payment_method', 'like', '%transfer%')
                  ->orWhere('payment_channel', 'like', '%bca%')
                  ->orWhere('payment_channel', 'like', '%bni%')
                  ->orWhere('payment_channel', 'like', '%bri%')
                  ->orWhere('payment_channel', 'like', '%mandiri%');
            })->sum('total_amount');

        $ewalletTotal = Order::where('status', '!=', 'cancelled')
            ->whereHas('payment', function($q) {
                $q->where('payment_method', 'like', '%wallet%')
                  ->orWhere('payment_channel', 'like', '%gopay%')
                  ->orWhere('payment_channel', 'like', '%ovo%')
                  ->orWhere('payment_channel', 'like', '%dana%')
                  ->orWhere('payment_channel', 'like', '%shopee%');
            })->sum('total_amount');

        $qrisTotal = Order::where('status', '!=', 'cancelled')
            ->whereHas('payment', function($q) {
                $q->where('payment_method', 'like', '%qris%')
                  ->orWhere('payment_channel', 'like', '%qris%');
            })->sum('total_amount');

        // Jika salah satu belum tercatat spesifik tetapi ada order lain
        if ($bankTotal == 0 && $ewalletTotal == 0 && $qrisTotal == 0 && $totalRevenue > 0) {
            $qrisTotal = $totalRevenue;
        }

        // Top Selling Products
        $topProducts = OrderItem::with('product')
            ->select('product_id', 'product_name', 'product_image', DB::raw('SUM(subtotal) as revenue'), DB::raw('SUM(quantity) as units_sold'))
            ->groupBy('product_id', 'product_name', 'product_image')
            ->orderByDesc('units_sold')
            ->limit(10)
            ->get();

        return view('admin.salesreport', compact('totalRevenue', 'totalOrders', 'newCustomers', 'bankTotal', 'ewalletTotal', 'qrisTotal', 'topProducts'));
    }

    /**
     * Display Orders list
     */
    public function orders()
    {
        $orders = Order::with(['items', 'payment'])->latest()->get();
        $totalOrders = $orders->count();
        $pendingOrders = $orders->whereIn('status', ['pending'])->count();
        $shippedOrders = $orders->whereIn('status', ['shipped', 'dispatched'])->count();
        $deliveredOrders = $orders->where('status', 'delivered')->count();
        $cancelledOrders = $orders->where('status', 'cancelled')->count();
        return view('admin.orders', compact('orders','totalOrders','pendingOrders','shippedOrders','deliveredOrders','cancelledOrders'));
    }

    /**
     * Display Order Detail
     */
    public function orderDetail($id = null)
    {
        $order = $id ? Order::with(['items','payment','user'])->where('order_number', $id)->orWhere('id', $id)->first() : null;
        return view('admin.orderdetail', compact('id', 'order'));
    }

    /**
     * Display Products list
     */
    public function products()
    {
        $products = Product::latest()->get();
        $totalItems = $products->count();
        $inventoryValue = $products->sum('price');
        $lowStock = $products->where('stock', '<=', 5)->where('stock', '>', 0)->count();
        $outOfStock = $products->where('stock', '<=', 0)->count();
        return view('admin.productadmin', compact('products', 'totalItems', 'inventoryValue', 'lowStock', 'outOfStock'));
    }

    /**
     * Display Add Product page
     */
    public function addItem()
    {
        $categories = Category::all();
        return view('admin.additem', compact('categories'));
    }

    /**
     * Store newly created Product in database
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'itemName' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required',
        ]);

        $priceClean = preg_replace('/[^\d]/', '', (string)$request->input('price'));
        $price = $priceClean ? (float)$priceClean : 0;
        $stock = (int)$request->input('stock', 1);

        // Upload foto utama langsung ke public/uploads/products
        $mainImagePath = 'assets/img/cat1.jpg'; // default fallback
        if ($request->hasFile('upMain') && $request->file('upMain')->isValid()) {
            $file = $request->file('upMain');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $mainImagePath = 'uploads/products/' . $filename;
        }

        // Upload gallery angle langsung ke public/uploads/products
        $galleryImages = [];
        foreach (['upA2', 'upA3', 'upA4', 'upA5'] as $angleKey) {
            if ($request->hasFile($angleKey) && $request->file($angleKey)->isValid()) {
                $file = $request->file($angleKey);
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);
                $galleryImages[] = 'uploads/products/' . $filename;
            }
        }

        $category = Category::where('name', $request->input('category'))
            ->orWhere('slug', Str::slug($request->input('category')))
            ->first();

        // Generate unique product code
        $prefix = strtoupper(substr($request->input('category', 'PRO'), 0, 3));
        $num = Product::count() + 1;
        do {
            $code = 'ZRB-' . $prefix . '-' . str_pad($num, 3, '0', STR_PAD_LEFT);
            $exists = Product::where('code', $code)->exists();
            if ($exists) {
                $num++;
            }
        } while ($exists);

        Product::create([
            'code' => $code,
            'name' => $request->input('itemName'),
            'slug' => Str::slug($request->input('itemName')) . '-' . Str::random(4),
            'category_id' => $category?->id,
            'category_name' => $request->input('category'),
            'price' => $price,
            'stock' => $stock,
            'main_image' => $mainImagePath,
            'gallery_images' => $galleryImages,
            'short_description' => Str::limit($request->input('description', ''), 120),
            'description' => $request->input('description'),
            'additional_information' => $request->input('addInfo'),
            'sizes' => ['s', 'm', 'l', 'xl'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.products')->with('success', 'Item berhasil dipublish ke database!');
    }

    /**
     * Delete Product from database
     */
    public function deleteProduct($id)
    {
        $product = Product::where('code', $id)->orWhere('id', $id)->first();
        if ($product) {
            $product->delete();
        }
        return response()->json(['success' => true]);
    }

    /**
     * Display Edit Product page
     */
    public function editItem($id = null)
    {
        $product = $id ? Product::where('code', $id)->orWhere('id', $id)->first() : null;
        $categories = Category::all();
        return view('admin.edititem', compact('id', 'product', 'categories'));
    }

    /**
     * Update Product in database
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::where('code', $id)->orWhere('id', $id)->firstOrFail();

        $request->validate([
            'itemName' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required',
        ]);

        $priceClean = preg_replace('/[^\d]/', '', (string)$request->input('price'));
        $price = $priceClean ? (float)$priceClean : $product->price;
        $stock = (int)$request->input('stock', $product->stock);

        // Upload foto utama baru jika ada
        if ($request->hasFile('upMain') && $request->file('upMain')->isValid()) {
            $file = $request->file('upMain');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $product->main_image = 'uploads/products/' . $filename;
        }

        // Upload gallery angle baru jika ada
        $galleryImages = is_array($product->gallery_images) ? $product->gallery_images : [];
        $angleKeys = [
            0 => 'upA2',
            1 => 'upA3',
            2 => 'upA4',
            3 => 'upA5',
        ];

        foreach ($angleKeys as $idx => $angleKey) {
            if ($request->hasFile($angleKey) && $request->file($angleKey)->isValid()) {
                $file = $request->file($angleKey);
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);
                $galleryImages[$idx] = 'uploads/products/' . $filename;
            }
        }
        // Pastikan urutan array rapi
        ksort($galleryImages);
        $galleryImages = array_values($galleryImages);

        $category = Category::where('name', $request->input('category'))
            ->orWhere('slug', Str::slug($request->input('category')))
            ->first();

        $product->name = $request->input('itemName');
        $product->category_id = $category?->id ?? $product->category_id;
        $product->category_name = $request->input('category');
        $product->price = $price;
        $product->stock = $stock;
        $product->gallery_images = $galleryImages;
        $product->short_description = Str::limit($request->input('description', ''), 120);
        $product->description = $request->input('description');
        $product->additional_information = $request->input('addInfo');
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Item berhasil diperbarui!');
    }

    /**
     * Display Users list
     */
    public function users()
    {
        $users = User::where('role', 'customer')->latest()->get();
        $totalCustomers = $users->count();
        $newCustomers = User::where('role', 'customer')->where('created_at', '>=', now()->subDays(7))->count();
        return view('admin.users', compact('users', 'totalCustomers', 'newCustomers'));
    }

    /**
     * Display User Detail page
     */
    public function viewUser($id = null)
    {
        $user = $id ? User::find($id) : null;
        $orders = $user ? Order::where('user_id', $user->id)->with('items')->latest()->get() : collect();
        return view('admin.viewuser', compact('id', 'user', 'orders'));
    }

    /**
     * Display View Product page
     */
    public function viewItem($id = null)
    {
        $product = $id ? Product::where('code', $id)->orWhere('id', $id)->first() : null;
        $reviews = $product ? $product->reviews()->latest()->get() : collect();
        return view('admin.viewitem', compact('id', 'product', 'reviews'));
    }
}

