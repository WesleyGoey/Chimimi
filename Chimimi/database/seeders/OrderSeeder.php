<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = \App\Models\Order::factory(100)->create(['amount' => 0]);

        $products = \App\Models\Product::all();
        $faker = \Faker\Factory::create();

        foreach ($orders as $order) {
            $totalAmount = 0;
            $selectedProducts = $products->random(rand(1, 6));
            foreach ($selectedProducts as $product) {
                $productType = $faker->randomElement(['Frozen', 'Cooked']);
                $priceAtOrder = ($productType == 'Frozen') ? $product->price_frozen : $product->price_cooked;
                $quantity = rand(1, 5);

                $order->products()->attach($product->id, [
                    'product_type' => $productType,
                    'price_at_order' => $priceAtOrder,
                    'quantity' => $quantity,
                ]);
                $totalAmount += $priceAtOrder * $quantity;
            }
            $order->amount = $totalAmount;
            $order->save();
        }
    }
}
