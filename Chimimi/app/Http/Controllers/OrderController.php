<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
	public function index()
    {
        $orders = Order::with('products')->get();
        return view('orders.index', compact('orders'));
    }
    public function cart()
    {
        $profile = null;
        if (auth()->check()) {
            $profile = Profile::with('orders.products')
                ->where('email', auth()->user()->email)
                ->first();
        }

        // fallback for development / seeded data
        $profile = $profile ?? Profile::with('orders.products')->first();
        $order = $profile ? $profile->orders->first() : null;

        return view('cart', compact('profile', 'order'));
    }
}
