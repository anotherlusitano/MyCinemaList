<?php

namespace App\Http\Controllers;

use App\Models\Movie;

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
}
