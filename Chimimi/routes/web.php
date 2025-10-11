<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);

Route::get('/reviews', [ReviewController::class, 'index']);

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/profile', function () {
    return view('profile');
});
