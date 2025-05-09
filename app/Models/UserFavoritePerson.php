<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFavoritePerson extends Model
{
    /** @use HasFactory<\Database\Factories\UserFavoritePersonFactory> */
    use HasFactory;

    protected $table = 'user_favorite_people';

    protected $fillable = [
        'user_id',
        'person_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
