<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'phone' => '12345678',
            'status' => 'admin'
        ]);

        User::create([
            'username' => 'Member',
            'email' => 'member@gmail.com',
            'password' => bcrypt('member123'),
            'phone' => '87654321',
            'status' =>'member'
        ]);
    }
}
