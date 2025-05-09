<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /** @use HasFactory<\Database\Factories\PersonFactory> */
    use HasFactory;

    protected $table = 'people';

    protected $guarded = [];

    public function favoritedByUsers()
    {
        return $this->hasMany(UserFavoritePerson::class);
    }
}
