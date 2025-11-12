<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Profile;

class ReviewController extends Controller
{
    public function index()
    {
        $profile = Profile::getFirstPerson();
        $reviews = $profile->reviews()->latest()->get();
        return view('reviews', compact('reviews'));
    }
}
