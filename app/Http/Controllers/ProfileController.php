<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $movieProgressList = $user->movieProgessList()->get();
        $favoritePeople = $user->favoritePeople()->get();
        $favoriteMovies = $user->favoriteMovies()->get();
        $reviews = $user->reviews()->orderByDesc('created_at')->get();

        return view('profile.show', [
            'user' => $user,
            'reviews' => $reviews,
            'favoriteMovies' => $favoriteMovies,
            'favoritePeople' => $favoritePeople,
            'movieProgressList' => $movieProgressList,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile picture.
     */
    public function update_picture(User $user)
    {
        request()->validate([
            'picture' => ['image', 'nullable', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ]);

        $picture = $user->picture;

        // person.png is the default picture
        if (request('picture') && $picture !== 'person.png' && Str::doesntContain($picture, 'http')) {

            // Will delete the previous picture from the storage
            unlink(public_path($picture));
        }

        if (request()->hasFile('picture')) {
            $path = request()->file('picture')->store('users', 'public');
            $picture = '/storage/' . $path;
        }

        $user->update([
            'picture' => $picture,
        ]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function movieStatus(User $user)
    {
        $status = request()->query('status') ?? '';

        return match ($status) {
            'dropped' => view('profile.movie-status', [
                'user' => $user,
                'progressList' => $user->movieProgessList()->where('watch_status', 'dropped')->get(),
            ]),
            'plan-to-watch' => view('profile.movie-status', [
                'user' => $user,
                'progressList' => $user->movieProgessList()->where('watch_status', 'plan-to-watch')->get(),
            ]),
            default => view('profile.movie-status', [
                'user' => $user,
                'progressList' => $user->movieProgessList()->where('watch_status', 'completed')->get(),
            ]),
        };
    }
}
