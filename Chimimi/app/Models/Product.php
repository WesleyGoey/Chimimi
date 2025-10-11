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
        'price_ready_to_eat',
        'image_path'
    ];
    public static function bestSellers()
    {
        return self::whereIn('id', [1, 2, 6])->get(['image_path', 'name']);
    }
    public static function allProducts()
    {
        return self::all();
    }
}
