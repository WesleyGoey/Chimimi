<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::getFirstPerson();
        $order = $profile->orders()->with('products')->first();
        $reviews = $profile->reviews()->latest()->get();
        return view('profile', compact('profile', 'order', 'reviews'));
    }
}
