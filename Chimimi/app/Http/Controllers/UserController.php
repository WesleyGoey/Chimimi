<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with(['orders', 'reviews'])->find(Auth::id());

        $order = $user->orders()->with('products')->latest()->first();
        $reviews = $user->reviews()->latest()->get();
        
        return view('user', compact('user', 'order', 'reviews'));
    }
}
