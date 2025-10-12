<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Review;
use App\Models\Order;
use App\Models\OrderProduct;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            ProfileSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class
        ]);
    }
}
