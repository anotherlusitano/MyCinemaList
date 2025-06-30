<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFavoriteMovie;
use App\Models\UserFavoritePerson;
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

    public function favoritePerson()
    {
        request()->validate([
            'person_id' => ['required', 'numeric']
        ]);

        UserFavoritePerson::create([
            'user_id' => Auth::user()->id,
            'person_id' => request('person_id'),
        ]);

        return redirect()->back();
    }

    public function removeFavoritePerson()
    {
        request()->validate([
            'person_id' => ['required', 'numeric']
        ]);

        UserFavoritePerson::query()
            ->where('person_id', request('person_id'))
            ->where('user_id', Auth::user()->id)
            ->delete();

        return redirect()->back();
    }

    public function favoritePeople(User $user)
    {
        return view('profile.favorite.people', [
            'user' => $user,
            'favorites' => $user->favoritePeople()->paginate(8),
        ]);
    }
}
