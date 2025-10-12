<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productType = $this->faker->randomElement(['Frozen', 'Cooked']);
        $product = \App\Models\Product::inRandomOrder()->first();
        $priceAtOrder = ($productType == 'Frozen') ? $product->price_frozen : $product->price_cooked;

        return [
            'order_id' => \App\Models\Order::inRandomOrder()->first()->id,
            'product_id' => $product->id,
            'product_type' => $productType,
            'price_at_order' => $priceAtOrder,
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
