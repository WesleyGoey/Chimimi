<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminProductController;

Route::get('/', function () {
    return view('home');
});

// Breeze routes (login, register, etc)
require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', function () {
        $ordersCount = \App\Models\Order::count();
        $reviewsCount = \App\Models\Review::count();

        return view('admin.dashboard', compact('ordersCount', 'reviewsCount'));
    })->name('admin.dashboard');

    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/orders', function () {
        $orders = \App\Models\Order::with(['user', 'products'])->orderBy('created_at', 'desc')->get();

        return view('admin.orders', compact('orders'));
    })->name('admin.orders');
    
    Route::get('/reviews', function () {
        $reviews = \App\Models\Review::with('user')->latest()->get();

        return view('admin.reviews', compact('reviews'));
    })->name('admin.reviews');
});
