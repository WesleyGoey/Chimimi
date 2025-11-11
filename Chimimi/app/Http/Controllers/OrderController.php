<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Profile;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->get();
        return view('orders.index', compact('orders'));
    }

    // Perbaikan: ambil cart milik profile yang login
    public function cart()
    {
        // Ambil profile dari auth (langsung, karena Profile adalah user)
        $profile = Profile::getFirstPerson();
        // Ambil order yang belum dibayar (cart)
        $order = $profile->orders()->where('isPaid', false)->with('products')->latest()->first();

        return view('cart', compact('profile', 'order'));
    }
}
