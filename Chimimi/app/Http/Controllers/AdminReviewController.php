<?php

namespace App\Http\Controllers;

use App\Models\Review;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->latest()->paginate(5);
        return view('admin.reviews', compact('reviews'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews')->with('success', 'Review deleted!');
    }
}