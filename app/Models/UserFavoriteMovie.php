<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFavoriteMovie extends Model
{
    /** @use HasFactory<\Database\Factories\UserFavoriteMovieFactory> */
    use HasFactory;

    protected $table = 'user_favorite_movies';

    protected $fillable = [
        'user_id',
        'movie_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
