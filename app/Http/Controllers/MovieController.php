<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies_released = Movie::query()
            ->where('status', 'released')
            ->withAvg('movieProgressByUsers', 'score')
            ->orderByDesc('release_year')
            ->orderByDesc('movie_progress_by_users_avg_score')
            ->latest()
            ->limit(20)
            ->get();

        $top_movies = Movie::query()
            ->where('status', 'released')
            ->withAvg('movieProgressByUsers', 'score')
            ->orderByDesc('movie_progress_by_users_avg_score')
            ->take(20)
            ->get();

        $movies_for_release = Movie::query()
            ->where('status', 'unreleased')
            ->orderByDesc('release_year')
            ->latest()
            ->limit(20)
            ->get();

        return view('index', [
            'movies_released' => $movies_released,
            'top_movies' => $top_movies,
            'movies_for_release' => $movies_for_release,
        ]);
    }

    public function show(Movie $movie)
    {
        $score = $movie->movieProgressByUsers()->avg('score');

        return view('movies.show', [
            'movie' => $movie,
            'score' => $score,
            'staff' => $movie->staff
        ]);
    }
}
