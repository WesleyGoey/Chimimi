<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'ingredients',
        'price_frozen',
        'price_cooked',
        'image_path'
    ];
    public function orders()
    {
        return $this->belongsToMany(
            \App\Models\Order::class,
            'order_products',
            'product_id',
            'order_id'
        )->withPivot('product_type', 'price_at_order', 'quantity');
    }
    public static function bestSellers()
    {
        return self::whereIn('id', [1, 2, 6])->get(['image_path', 'name']);
    }
}
