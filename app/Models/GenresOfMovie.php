<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GenresOfMovie extends Model
{
    protected $fillable = ['movie_id', 'genre_id'];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
