<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Beef Mayo',
                'category' => 'Savory',
                'ingredients' => 'Smoked Beef, Mayonnaise, egg and Cheese',
                'price_frozen' => 50.00,
                'price_ready_to_eat' => 55.00,
                'image_path' => 'images/savory_beef_mayo.jpeg',
            ],
            [
                'name' => 'Beef Mentai',
                'category' => 'Savory',
                'ingredients' => 'Smoked Beef, Mentai Sauces, egg and Cheese',
                 'price_frozen' => 50.00,
                'price_ready_to_eat' => 55.00,
                'image_path' => 'images/savory_beef_mentai.jpeg',
            ],
            [
                'name' => 'Crabbie Mentai',
                'category' => 'Savory',
                'ingredients' => 'Crab Stick, Mentai Sauces, egg and Cheese',
                'price_frozen' => 50.00,
                'price_ready_to_eat' => 55.00,
                'image_path' => 'images/savory_crabbie_mentai.jpeg',
            ],
            [
                'name' => 'Chikin Shroom',
                'category' => 'Savory',
                'ingredients' => 'Shredded Chicken and Mushroom Sauce',
                'price_frozen' => 50.00,
                'price_ready_to_eat' => 55.00,
                'image_path' => 'images/savory_chikin_shroom.jpeg',
            ],
            [
                'name' => 'Choco Bomb',
                'category' => 'Sweet',
                'ingredients' => 'Chocolate Ganache and Choco Crunch',
                'price_frozen' => 50.00,
                'price_ready_to_eat' => 55.00,
                'image_path' => 'images/sweet_choco_bomb.jpeg',
            ],
            [
                'name' => 'Choco Chezz',
                'category' => 'Sweet',
                'ingredients' => 'Chocolate Paste, Cheese Slice and Cheese Sauce',
                'price_frozen' => 50.00,
                'price_ready_to_eat' => 55.00,
                'image_path' => 'images/sweet_choco_chezz.jpeg',
            ],
        ]);
    }
}
