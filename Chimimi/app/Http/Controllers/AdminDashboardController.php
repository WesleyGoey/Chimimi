<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $reviewsCount = Review::count(); 
        return view('admin.dashboard', compact('productsCount', 'ordersCount', 'reviewsCount'));
    }
}