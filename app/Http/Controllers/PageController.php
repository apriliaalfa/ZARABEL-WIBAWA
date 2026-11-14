<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display Homepage 1 (Guest / Public Homepage).
     */
    public function homepage1(): View
    {
        $products = Product::where('is_active', true)->latest()->get();
        return view('pages.homepage1', [
            'user' => Auth::user(),
            'products' => $products,
        ]);
    }

    /**
     * Display Homepage 2 (Authenticated / Member Homepage).
     */
    public function homepage2(): View
    {
        $products = Product::where('is_active', true)->latest()->get();
        return view('pages.homepage2', [
            'user' => Auth::user(),
            'products' => $products,
        ]);
    }

    /**
     * Display Catalog page.
     */
    public function catalog(Request $request): View
    {
        $query = Product::where('is_active', true);
        if ($request->has('cat') && $request->input('cat') !== 'All') {
            $query->where('category_name', $request->input('cat'));
        }
        $products = $query->latest()->get();
        $categories = Category::all();

        return view('pages.catalog', [
            'user' => Auth::user(),
            'products' => $products,
            'categories' => $categories,
            'currentCat' => $request->input('cat', 'All'),
        ]);
    }

    /**
     * Display About Us page.
     */
    public function about(): View
    {
        return view('pages.aboutus', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Display Shopping Cart page.
     */
    public function cart(): View
    {
        return view('pages.cart', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Display Product Detail page.
     */
    public function product($id = null): View
    {
        $product = null;
        if ($id) {
            $product = Product::where('code', $id)->orWhere('slug', $id)->orWhere('id', $id)->first();
        }
        if (!$product) {
            $product = Product::where('is_active', true)->first();
        }

        return view('pages.product', [
            'user' => Auth::user(),
            'product' => $product,
            'reviews' => $product ? $product->reviews()->latest()->get() : collect(),
        ]);
    }

    /**
     * Display Profile page.
     */
    public function profile(): View
    {
        return view('pages.profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Display My Orders list.
     */
    public function myorder(): View
    {
        $orders = collect();
        if (Auth::check()) {
            $user = Auth::user();
            $orders = Order::where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('customer_email', $user->email);
            })->with('items')->latest()->get();
        }

        return view('pages.myorder1', [
            'user' => Auth::user(),
            'orders' => $orders,
        ]);
    }

    /**
     * Display Order Detail page.
     */
    public function myorderDetail(string $id = ''): View
    {
        $order = $id ? Order::where('order_number', $id)->with(['items', 'payment'])->first() : null;
        return view('pages.myorder2', [
            'user' => Auth::user(),
            'id' => $id,
            'order' => $order,
        ]);
    }

    /**
     * Display Checkout Step 1 (Contact & Address).
     */
    public function checkout1(): View
    {
        return view('pages.checkout1', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Display Checkout Step 2 (Shipping & Payment).
     */
    public function checkout2(Request $request): View
    {
        $snapJs = config('services.midtrans.is_production', false)
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
        $clientKey = config('services.midtrans.client_key', env('MIDTRANS_CLIENT_KEY', ''));

        return view('pages.checkout2', [
            'user' => Auth::user(),
            'snapJs' => $snapJs,
            'clientKey' => $clientKey,
        ]);
    }

    /**
     * Display Checkout Step 3 (Confirmation).
     */
    public function confirm(): View
    {
        return view('pages.confirm', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Display Payment Success Receipt.
     */
    public function success(Request $request): View
    {
        $orderNumber = $request->query('order');
        $order = $orderNumber ? Order::where('order_number', $orderNumber)->with(['items', 'payment'])->first() : null;

        return view('pages.success', [
            'user' => Auth::user(),
            'order' => $order,
        ]);
    }

    /**
     * Display Error / 404 page.
     */
    public function errorPage(): View
    {
        return view('pages.error', [
            'user' => Auth::user(),
        ]);
    }
}
