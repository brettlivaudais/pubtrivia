<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'city',
        'state',
        'zip',
        'slug',
        'lat',
        'long',
        'dayoftheweek',
        'time',
        'logo_url',
        'published',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(UserLocationRating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
