<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::find(1);
        $order = $profile ? $profile->orders()->with('products')->first() : null;
        return view('profile', compact('profile', 'order'));
    }
}
