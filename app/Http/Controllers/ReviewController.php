<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|integer|exists:movies,id',
            'recommendation' => 'required|in:recommended,mixed feelings,not recommended',
            'text' => 'required|string|min:50|max:1000',
        ]);

        Review::create([
            'movie_id' => $validated['movie_id'],
            'user_id' => auth()->id(),
            'text' => $validated['text'],
            'recommendation' => $validated['recommendation'],
        ]);

        return redirect()->back()->with('success', 'Review submitted!');
    }

    public function update(Review $review)
    {
        request()->validate([
            'recommendation' => ['required', 'in:recommended,mixed feelings,not recommended'],
            'text' => ['required', 'string', 'min:50', 'max:1000'],
        ]);

        $review->update([
            'recommendation' => request('recommendation'),
            'text' => request('text'),
        ]);

        return redirect()->back();
    }

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
        $reviews = $user->reviews()->orderByDesc('created_at')->paginate(3);

        return view('profile.reviews', [
            'reviews' => $reviews,
            "user" => $user
        ]);
    }
}
