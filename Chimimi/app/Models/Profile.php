<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function getFirstPerson()
    {
        return self::first();
    }
}
