<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'picture',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function review(Movie $movie)
    {
        return $this->reviews()->where('movie_id', $movie->id)->first();
    }

    public function favoritePeople()
    {
        return $this->hasMany(UserFavoritePerson::class);
    }

    public function favoriteMovies()
    {
        return $this->hasMany(UserFavoriteMovie::class);
    }

    public function movieProgessList()
    {
        return $this->hasMany(UserMovieProgress::class);
    }

    // Returns true if the user have that movie as a favorite
    public function hasFavoriteMovie(Movie $movie): bool
    {
        return $this->favoriteMovies->doesntContain('movie_id', $movie->id);
    }

    // Returns true if the user have that person as a favorite
    public function hasFavoritePerson(Person $person): bool
    {
        return $this->favoritePeople->doesntContain('person_id', $person->id);
    }
}
