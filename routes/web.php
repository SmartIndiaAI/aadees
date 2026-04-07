<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/toggle/{productId}', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::post('/wishlist/move-to-cart/{productId}', [App\Http\Controllers\WishlistController::class, 'moveToCart'])->name('wishlist.move_to_cart');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{cartKey}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// Checkout (Requires Login)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'handlePaymentSuccess'])->name('checkout.success');
});

/*
|--------------------------------------------------------------------------
| Multi-Auth & Password Reset Routes
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;

// Auth Routes Factory
foreach (['user', 'admin', 'vendor'] as $role) {
    $prefix = $role === 'user' ? '' : $role . '/';
    $namePrefix = $role === 'user' ? '' : $role . '.';

    Route::prefix($prefix)->name($namePrefix)->group(function () use ($role) {
        // Login & Logout
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->defaults('role', $role);
        Route::post('/login', [AuthController::class, 'login'])->defaults('role', $role);
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->defaults('role', $role);

        // Registration (Except Admin)
        if ($role !== 'admin') {
            Route::get('/register', [RegisterController::class, 'showRegistration'])->name('register')->defaults('role', $role);
            Route::post('/register', [RegisterController::class, 'register'])->defaults('role', $role);
        }

        // Password Reset
        Route::get('/password/reset', [PasswordResetController::class, 'showRequestView'])->name('password.request')->defaults('role', $role);
        Route::post('/password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email')->defaults('role', $role);
        Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset')->defaults('role', $role);
        Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update')->defaults('role', $role);
    });
}

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('vendors', App\Http\Controllers\Admin\VendorController::class);
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products');
    Route::get('/products/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/transfers', [App\Http\Controllers\Admin\DashboardController::class, 'transfers'])->name('transfers');
    Route::get('/settings', [App\Http\Controllers\Admin\DashboardController::class, 'settings'])->name('settings');
    Route::post('/settings/update', [App\Http\Controllers\Admin\DashboardController::class, 'updateSetting'])->name('settings.update');
});

Route::middleware('auth:vendor')->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Vendor\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', App\Http\Controllers\Vendor\ProductController::class);
    Route::get('/orders', [App\Http\Controllers\Vendor\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\Vendor\OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/status', [App\Http\Controllers\Vendor\OrderController::class, 'updateStatus'])->name('orders.status');
    Route::get('/earnings', [App\Http\Controllers\Vendor\DashboardController::class, 'earnings'])->name('earnings');
    Route::get('/help', [App\Http\Controllers\Vendor\DashboardController::class, 'help'])->name('guide');
    Route::get('/settings', [App\Http\Controllers\Vendor\DashboardController::class, 'settings'])->name('settings');
    Route::post('/settings', [App\Http\Controllers\Vendor\DashboardController::class, 'updateSettings'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
});
