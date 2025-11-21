<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
    public function cart(Request $request)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()
            ->where('isPaid', false)
            ->whereDoesntHave('products', function ($q) {})
            ->orWhere(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->where('isPaid', false)
                    ->where('amount', 0);
            })
            ->with('products')
            ->latest()
            ->first();

        if ($request->session()->has('just_ordered')) {
            $order = null;
            $request->session()->forget('just_ordered');
        }

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

    public function selectProduct(Product $product)
    {
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
        $product = Product::find($productId);
        $priceAtOrder = ($productType == 'Frozen') ? $product->price_frozen : $product->price_cooked;

        $order = $user->orders()->where('isPaid', false)->where('amount', 0)->latest()->first();
        if (!$order) {
            $order = $user->orders()->create([
                'amount' => 0,
                'isPaid' => false,
            ]);
        }

        $existingPivot = DB::table('order_products')
            ->where('order_id', $order->id)
            ->where('product_id', $productId)
            ->where('product_type', $productType)
            ->first();

        if ($existingPivot) {
            DB::table('order_products')
                ->where('order_id', $order->id)
                ->where('product_id', $productId)
                ->where('product_type', $productType)
                ->update([
                    'quantity' => $existingPivot->quantity + $quantity,
                    'price_at_order' => $priceAtOrder,
                    'updated_at' => now()
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

    public function editCart(Product $product, $productType)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()->where('isPaid', false)->where('amount', 0)->latest()->first();
        $pivot = $order->products()->wherePivot('product_type', $productType)->where('products.id', $product->id)->first()->pivot;
        $quantity = $pivot->quantity;
        return view('order.cart-edit', compact('product', 'productType', 'quantity'));
    }

    public function updateCart(Request $request, Product $product, $oldProductType)
    {
        $request->validate([
            'product_type' => 'required|in:Frozen,Cooked',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = User::find(Auth::id());
        $order = $user->orders()
            ->where('isPaid', false)
            ->where('amount', 0)
            ->latest()
            ->first();

        $newType = $request->product_type;
        $quantity = $request->quantity;
        $priceAtOrder = ($newType == 'Frozen') ? $product->price_frozen : $product->price_cooked;

        if ($newType !== $oldProductType) {
            $existingNewType = DB::table('order_products')
                ->where('order_id', $order->id)
                ->where('product_id', $product->id)
                ->where('product_type', $newType)
                ->first();

            if ($existingNewType) {
                DB::table('order_products')
                    ->where('order_id', $order->id)
                    ->where('product_id', $product->id)
                    ->where('product_type', $newType)
                    ->update([
                        'quantity' => $existingNewType->quantity + $quantity,
                        'price_at_order' => $priceAtOrder,
                        'updated_at' => now()
                    ]);

                DB::table('order_products')
                    ->where('order_id', $order->id)
                    ->where('product_id', $product->id)
                    ->where('product_type', $oldProductType)
                    ->delete();
            } else {
                DB::table('order_products')
                    ->where('order_id', $order->id)
                    ->where('product_id', $product->id)
                    ->where('product_type', $oldProductType)
                    ->update([
                        'product_type' => $newType,
                        'price_at_order' => $priceAtOrder,
                        'quantity' => $quantity,
                        'updated_at' => now()
                    ]);
            }
        } else {
            DB::table('order_products')
                ->where('order_id', $order->id)
                ->where('product_id', $product->id)
                ->where('product_type', $newType)
                ->update([
                    'quantity' => $quantity,
                    'price_at_order' => $priceAtOrder,
                    'updated_at' => now()
                ]);
        }

        return redirect()->route('cart')->with('success', 'Cart item updated!');
    }

    public function removeFromCart(Product $product, $productType)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()
            ->where('isPaid', false)
            ->where('amount', 0)
            ->latest()
            ->first();

        if ($order) {
            $order->products()->wherePivot('product_type', $productType)->detach($product->id);

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

        $notes = $request->input('notes');
        if ($notes !== null) {
            $order->notes = trim($notes) === '' ? null : $notes;
        }

        $order->amount = $amount;
        $order->save();

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

        return view('order.order-history', compact('orderHistory'));
    }
}
