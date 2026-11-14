<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\WebsiteReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display Homepage 1 (Guest / Public Homepage).
     */
    public function homepage1(): View
    {
        $products = Product::where('is_active', true)->latest()->get();
        $reviews = Schema::hasTable('website_reviews') ? WebsiteReview::latest()->take(10)->get() : collect();
        return view('pages.homepage1', [
            'user' => Auth::user(),
            'products' => $products,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Display Homepage 2 (Authenticated / Member Homepage).
     */
    public function homepage2(): View
    {
        $products = Product::where('is_active', true)->latest()->get();
        $reviews = Schema::hasTable('website_reviews') ? WebsiteReview::latest()->take(10)->get() : collect();
        return view('pages.homepage2', [
            'user' => Auth::user(),
            'products' => $products,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Store website review from modal.
     */
    public function storeWebsiteReview(Request $request)
    {
        $request->validate([
            'ulasan' => 'required|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $user = Auth::user();
        WebsiteReview::create([
            'user_id' => $user?->id,
            'user_name' => $user?->name ?? 'Customer',
            'user_role' => $user?->role === 'admin' ? 'Admin' : 'Verified Buyer',
            'user_avatar' => $user?->avatar,
            'rating' => (int)$request->input('rating', 5) ?: 5,
            'comment' => $request->input('ulasan'),
        ]);

        return redirect()->back()->with('review_success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
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
     * Update Profile in database.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $first = trim((string)$request->input('first', ''));
        $last = trim((string)$request->input('last', ''));
        $name = trim($first . ' ' . $last);
        if (!empty($name)) {
            $user->name = $name;
        }

        if ($request->has('phone')) {
            $user->phone = $request->input('phone');
        }

        if ($request->has('address')) {
            $user->address = $request->input('address');
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $file = $request->file('avatar');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $filename);
            $user->avatar = 'uploads/avatars/' . $filename;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui di database!',
            'user' => [
                'name' => $user->name,
                'avatar' => $user->avatar ? asset($user->avatar) : null
            ]
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
