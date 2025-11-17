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

    public function history()
    {
        $orders = \App\Models\Order::with(['user', 'products'])
            ->where('isPaid', true)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.order-history', compact('orders'));
    }
}