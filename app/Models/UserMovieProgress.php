<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMovieProgress extends Model
{
    /** @use HasFactory<\Database\Factories\UserMovieProgressFactory> */
    use HasFactory;

    /**
     * @var \Illuminate\Support\Carbon|mixed
     */
    public mixed $watch_status;
    public mixed $completed_watching_date;

    protected $fillable = [
        'user_id',
        'movie_id',
        'watch_status',
        'score',
        'completed_watching_date',
    ];

    protected $casts = [
        'completed_watching_date' => 'date',
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
