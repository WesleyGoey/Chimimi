<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->latest()->get();
        return view('reviews', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $user = User::with(['reviews'])->find(Auth::id());
        if (!$user) {
            return redirect()->route('login');
        }

        $user->reviews()->create([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reviews')->with('success', 'Review submitted!');
    }
}
