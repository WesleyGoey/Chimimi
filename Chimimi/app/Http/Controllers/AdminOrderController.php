<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'products'])->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }
}