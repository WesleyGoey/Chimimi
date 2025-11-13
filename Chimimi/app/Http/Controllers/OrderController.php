<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->get();
        return view('orders.index', compact('orders'));
    }

    public function cart()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }
        $order = $user->orders()->where('isPaid', false)->with('products')->latest()->first();
        return view('cart', compact('order'));
    }
};
