<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

// Breeze routes (login, register, etc)
require __DIR__.'/auth.php';

// Custom routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
    Route::get('/user', [UserController::class, 'index'])->name('user'); // Sudah ada middleware
    Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
});