<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'rating',
        'comment',
    ];

    public function reviewerProfile(){
        return $this->belongsTo(Profile::class);
    }
    public static function latestTenReviews(){
        return self::with('reviewerProfile')->latest()->take(10)->get();
    }
}
