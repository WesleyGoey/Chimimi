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
        $reviews = Review::with('user')->latest()->paginate(5);
        return view('reviews', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $user = User::with(['reviews'])->find(Auth::id());

        $user->reviews()->create([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reviews')->with('success', 'Review submitted!');
    }
    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reviews')->with('success', 'Review updated!');
    }
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews')->with('success', 'Review deleted!');
    }
}
