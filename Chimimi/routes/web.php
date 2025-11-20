<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;

require __DIR__ . '/auth.php';

Route::view('/', 'home')->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart/select/{product}', [OrderController::class, 'selectProduct'])->name('cart.select');
    Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
    Route::get('/cart/edit/{product}/{product_type}', [OrderController::class, 'editCart'])->name('cart.edit');
    Route::post('/cart/update/{product}/{product_type}', [OrderController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{product}/{product_type}', [OrderController::class, 'removeFromCart'])->name('cart.remove');

    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::post('/orders/{order}/pay', [AdminOrderController::class, 'pay'])->name('admin.orders.pay');
    Route::get('/order-history', [AdminOrderController::class, 'history'])->name('admin.orderHistory');

    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');
});
