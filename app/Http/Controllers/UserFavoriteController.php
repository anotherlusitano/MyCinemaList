<?php

namespace App\Http\Controllers;

use App\Models\UserFavoriteMovie;
use Illuminate\Support\Facades\Auth;

class UserFavoriteController extends Controller
{
    public function favoriteMovie()
    {
        request()->validate([
            'movie_id' => ['required', 'numeric']
        ]);

        UserFavoriteMovie::create([
            'user_id' => Auth::user()->id,
            'movie_id' => request('movie_id'),
        ]);

        return redirect()->back();
    }

    public function removeFavoriteMovie()
    {
        request()->validate([
            'movie_id' => ['required', 'numeric']
        ]);

        UserFavoriteMovie::query()
            ->where('movie_id', request('movie_id'))
            ->where('user_id', Auth::user()->id)
            ->delete();

        return redirect()->back();
    }
}
