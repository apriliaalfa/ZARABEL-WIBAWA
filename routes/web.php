<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage 1 (Guest / Public)
Route::get('/', [PageController::class, 'homepage1'])->name('homepage1');
Route::get('/home', [PageController::class, 'homepage1']);
Route::get('/homepage1', [PageController::class, 'homepage1'])->name('homepage1.view');

// Catalog
Route::get('/catalog', [PageController::class, 'catalog'])->name('catalog');

// About Us
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/about-us', fn () => redirect()->route('about'));

// Product Detail
Route::get('/product/{id?}', [PageController::class, 'product'])->name('product');

// Cart
Route::get('/cart', [PageController::class, 'cart'])->name('cart');

// Error / 404 page (public)
Route::get('/error', [PageController::class, 'errorPage'])->name('error');

// Member / Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/homepage2', [PageController::class, 'homepage2'])->name('homepage2');
    Route::get('/home2', fn () => redirect()->route('homepage2'));

    // Profile & Orders
    Route::get('/profile', [PageController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [PageController::class, 'updateProfile'])->name('profile.update');
    Route::get('/my-orders', [PageController::class, 'myorder'])->name('myorder');
    Route::get('/my-orders/detail/{id?}', [PageController::class, 'myorderDetail'])->name('myorder.detail');
    Route::post('/review-web', [PageController::class, 'storeWebsiteReview'])->name('review-web.store');
});

// Checkout Flow (Dapat diakses oleh Guest maupun Member)
Route::get('/checkout', [PageController::class, 'checkout1'])->name('checkout');
Route::get('/checkout1', fn () => redirect()->route('checkout'));
Route::get('/checkout/payment', [PageController::class, 'checkout2'])->name('checkout.payment');
Route::get('/checkout2', fn () => redirect()->route('checkout.payment'));
Route::get('/order/confirm', [PageController::class, 'confirm'])->name('order.confirm');
Route::get('/order/success', [PageController::class, 'success'])->name('order.success');

// Midtrans Payment Endpoints
Route::post('/payment/snap-token', [PaymentController::class, 'createSnapToken'])->name('payment.snap');
Route::post('/payment/notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');
Route::post('/payment/finish', [PaymentController::class, 'finishPayment'])->name('payment.finish');

// Authentication (Sign In & Sign Up)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Google OAuth Routes
    Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');
    Route::get('/auth/google/mock', fn () => redirect()->route('google.redirect', ['mock' => 1]))->name('google.mock');

    // Forgot Password Flow
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendConfirmationCode'])->name('password.send_code');

    Route::get('/confirm-code', [PasswordResetController::class, 'showConfirmCode'])->name('password.confirm');
    Route::post('/confirm-code', [PasswordResetController::class, 'verifyConfirmationCode'])->name('password.verify_code');

    Route::get('/new-password', [PasswordResetController::class, 'showNewPassword'])->name('password.new');
    Route::post('/new-password', [PasswordResetController::class, 'updatePassword'])->name('password.update');
});

// Logout
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/sales-report', [AdminController::class, 'salesReport'])->name('sales');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/detail/{id?}', [AdminController::class, 'orderDetail'])->name('orders.detail');
    Route::post('/orders/update-status/{id}', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/add', [AdminController::class, 'addItem'])->name('products.add');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::post('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('products.delete');
    Route::get('/products/edit/{id?}', [AdminController::class, 'editItem'])->name('products.edit');
    Route::post('/products/update/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::get('/products/view/{id?}', [AdminController::class, 'viewItem'])->name('products.view');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/view/{id?}', [AdminController::class, 'viewUser'])->name('users.view');
});
