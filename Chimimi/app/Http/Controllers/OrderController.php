<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->get();
        return view('orders.index', compact('orders'));
    }

    public function cart(Request $request)
    {
        $user = User::find(Auth::id());
        
        // Ambil order aktif (cart) - hanya order yang belum di-checkout
        $order = $user->orders()
            ->where('isPaid', false)
            ->whereDoesntHave('products', function($q) {
                // Order yang sudah pernah di-checkout akan punya amount > 0
            })
            ->orWhere(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->where('isPaid', false)
                  ->where('amount', 0);
            })
            ->with('products')
            ->latest()
            ->first();

        // Jika baru saja order now, sembunyikan cart
        if ($request->session()->has('just_ordered')) {
            $order = null;
            $request->session()->forget('just_ordered');
        }

        // Ambil semua order history yang sudah di-checkout (amount > 0) dengan pagination
        $orderHistory = $user->orders()
            ->where('amount', '>', 0)
            ->with('products')
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('cart', [
            'order' => $order,
            'orderHistory' => $orderHistory
        ]);
    }

    public function selectProduct($productId)
    {
        $product = \App\Models\Product::findOrFail($productId);
        return view('order.cart-select', compact('product'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_type' => 'required|in:Frozen,Cooked',
            'quantity' => 'required|integer|min:1'
        ]);
        $user = User::find(Auth::id());
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $productType = $request->product_type;
        $product = \App\Models\Product::find($productId);
        $priceAtOrder = ($productType == 'Frozen') ? $product->price_frozen : $product->price_cooked;

        $order = $user->orders()->where('isPaid', false)->where('amount', 0)->latest()->first();
        if (!$order) {
            $order = $user->orders()->create([
                'amount' => 0,
                'isPaid' => false,
            ]);
        }

        $existing = $order->products()
            ->where('products.id', $productId)
            ->wherePivot('product_type', $productType)
            ->first();

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

    public function updateType(Request $request, $productId)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()->where('isPaid', false)->where('amount', 0)->latest()->first();

        if ($order) {
            $productType = $request->product_type;
            $quantity = $request->quantity;
            $product = \App\Models\Product::find($productId);
            $priceAtOrder = ($productType == 'Frozen') ? $product->price_frozen : $product->price_cooked;
            $order->products()->updateExistingPivot($productId, [
                'product_type' => $productType,
                'price_at_order' => $priceAtOrder,
                'quantity' => $quantity
            ]);
        }
        return response()->json(['success' => true]);
    }
    
    public function updateQuantity(Request $request, $productId, $productType)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()->where('isPaid', false)->where('amount', 0)->latest()->first();

        if ($order) {
            $newQuantity = $request->quantity;
            if ($newQuantity < 1) $newQuantity = 1;
            $order->products()->wherePivot('product_type', $productType)->updateExistingPivot($productId, [
                'quantity' => $newQuantity
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function removeFromCart($productId, $productType)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()
            ->where('isPaid', false)
            ->where('amount', 0)
            ->latest()
            ->first();

        if ($order) {
            $order->products()->wherePivot('product_type', $productType)->detach($productId);
            
            // Jika order sudah tidak ada produk, hapus order dari database
            if ($order->products()->count() === 0) {
                $order->delete();
            }
        }

        return redirect()->route('cart')->with('success', 'Product removed from cart!');
    }

    public function checkout(Request $request)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()
            ->where('isPaid', false)
            ->where('amount', 0)
            ->with('products')
            ->latest()
            ->first();

        if (!$order || $order->products->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $amount = $order->products->sum(function ($product) {
            return ($product->pivot->product_type == 'Frozen' ? $product->price_frozen : $product->price_cooked) * $product->pivot->quantity;
        });

        // Update amount (tandai bahwa order ini sudah di-checkout)
        // Tetap unpaid, hanya set amount agar masuk history
        $order->amount = $amount;
        $order->save();

        // Set flag agar cart kosong di tampilan
        return redirect()->route('cart')->with([
            'just_ordered' => true,
            'success' => 'Order placed! Check your history below.'
        ]);
    }

    public function history(Request $request)
    {
        $user = User::find(Auth::id());
        $orderHistory = $user->orders()
            ->where('amount', '>', 0)
            ->with('products')
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('order-history', compact('orderHistory'));
    }
}
