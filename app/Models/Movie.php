<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $guarded = [];

    public function genres()
    {
        return $this->hasMany(GenresOfMovie::class);
    }

    public function favoritedByUsers()
    {
        return $this->hasMany(UserFavoriteMovie::class);
    }

    public function movieProgressByUsers()
    {
        return $this->hasMany(UserMovieProgress::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
