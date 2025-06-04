<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;

class ReviewController extends Controller
{
    public function movieReviews(Movie $movie)
    {
        $reviews = $movie->reviews()->paginate(3);

        return view('movies.reviews', [
            'reviews' => $reviews,
            "movie" => $movie
        ]);
    }

    public function userReviews(User $user)
    {
        $reviews = $user->reviews()->paginate(3);

        return view('profile.reviews', [
            'reviews' => $reviews,
            "user" => $user
        ]);
    }
}
