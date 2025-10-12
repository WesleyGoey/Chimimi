<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'amount',
        'isPaid',
        'notes'
    ];
    public function products()
    {
        return $this->belongsToMany(
            \App\Models\Product::class,
            'order_products',
            'order_id',
            'product_id'
        )->withPivot('product_type', 'price_at_order', 'quantity');
    }

    public function getFirstPersonOrder()
    {
        $orders = Order::where('profile_id', 1)->with('products')->get();
        return view('orders.index', [
            'orders' => $orders
        ]);
    }
}
