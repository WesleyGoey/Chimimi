<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->get();
        return view('orders.index', compact('orders'));
    }

    public function cart()
    {
        $user = User::find(Auth::id());
        // Cart aktif (belum dibayar)
        $order = $user->orders()->where('isPaid', false)->with('products')->latest()->first();
        // Semua order history (termasuk unpaid dan paid)
        $orderHistory = $user->orders()->where('isPaid', false)->whereHas('products')->with('products')->orderByDesc('created_at')->get();

        return view('cart', compact('order', 'orderHistory'));
    }

    public function addToCart(\Illuminate\Http\Request $request)
    {
        $user = User::find(Auth::id());
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;
        $productType = $request->product_type ?? 'Frozen';

        $product = Product::find($productId);
        $priceAtOrder = ($productType == 'Frozen') ? $product->price_frozen : $product->price_cooked;

        // Ambil order yang belum dibayar
        $order = $user->orders()->where('isPaid', false)->latest()->first();
        if (!$order) {
            $order = $user->orders()->create([
                'amount' => 0,
                'isPaid' => false,
            ]);
        }

        // Cek apakah produk sudah ada di cart
        $existing = $order->products()->where('products.id', $productId)->wherePivot('product_type', $productType)->first();

        if ($existing) {
            $order->products()->updateExistingPivot($productId, [
                'quantity' => $existing->pivot->quantity + $quantity,
                'product_type' => $productType,
                'price_at_order' => $priceAtOrder,
            ]);
        } else {
            $order->products()->attach($productId, [
                'product_type' => $productType,
                'price_at_order' => $priceAtOrder,
                'quantity' => $quantity
            ]);
        }

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function removeFromCart($productId)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()->where('isPaid', false)->latest()->first();
        if ($order) {
            $order->products()->detach($productId);
            // Jika order sudah tidak ada produk, hapus order dari database
            if ($order->products()->count() === 0) {
                $order->delete();
            }
        }
        return redirect()->route('cart')->with('success', 'Product removed from cart!');
    }

    public function checkout()
    {
        $user = User::find(Auth::id());
        $order = $user->orders()->where('isPaid', false)->with('products')->latest()->first();

        if (!$order || $order->products->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $amount = $order->products->sum(function ($product) {
            return ($product->pivot->product_type == 'Frozen' ? $product->price_frozen : $product->price_cooked) * $product->pivot->quantity;
        });

        // Tandai order sebagai unpaid (history)
        $order->amount = $amount;
        $order->isPaid = false;
        $order->save();

        // Cart dikosongkan (detach semua produk dari order aktif)
        $order->products()->detach();

        return redirect()->route('cart')->with('success', 'Order placed! Check your history below.');
    }
};
