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
}
