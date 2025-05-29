<?php

namespace App\Http\Controllers;

use App\Models\UserMovieProgress;
use Illuminate\Http\Request;

class UserMovieProgressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
        ]);

        UserMovieProgress::query()->firstOrCreate([
            'user_id' => auth()->id(),
            'movie_id' => $request->movie_id,
        ], [
            'watch_status' => 'plan-to-watch',
            'score' => null,
            'completed_watching_date' => null,
        ]);

        return back();
    }
}
