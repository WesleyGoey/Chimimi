<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'products'])
            ->where('isPaid', false)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.orders', compact('orders'));
    }

    public function history()
    {
        $orders = Order::with(['user', 'products'])
            ->where('isPaid', true)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.order-history', compact('orders'));
    }

    public function pay(Order $order)
    {
        if ($order->isPaid) {
            return redirect()->route('admin.orders')->with('info', 'Order already paid.');
        }

        $order->isPaid = true;
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order marked as paid.');
    }
}