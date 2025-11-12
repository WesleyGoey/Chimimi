<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::getFirstPerson();
        $order = $user->orders()->with('products')->first();
        $reviews = $user->reviews()->latest()->get();
        return view('user', compact('user', 'order', 'reviews'));
    }
}
