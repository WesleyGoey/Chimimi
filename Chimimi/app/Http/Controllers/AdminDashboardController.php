<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pendingOrdersCount = Order::where('isPaid', false)->count();
        $ordersCount = Order::where('amount', '>', 0)->count();
        $reviewsCount = Review::count(); 
        return view('admin.dashboard', compact('ordersCount', 'pendingOrdersCount', 'reviewsCount'));
    }
}