<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query') ?? '';
        $type = $request->query('type');

        switch ($type) {
            case 'people':
                return view('search.people', [
                    'people' => $this->filterPeople($query)->paginate(8),
                ]);
            case 'movies':
                return view('search.movies', [
                    'movies' => $this->filterMovies($query)->paginate(8),
                ]);
            case 'users':
                $sort_alpha = $request->query('sort_alpha') ?? 'asc';
                $sort_date = $request->query('sort_date') ?? 'asc';

                return view('search.users', [
                    'users' => $this->filterUsers($query, $sort_alpha, $sort_date)->paginate(8),
                ]);
            default:
                return view('search.index', [
                    'people' => $this->filterPeople($query)->limit(6)->get(),
                    'movies' => $this->filterMovies($query)->limit(6)->get(),
                    'users' => $this->filterUsers($query)->limit(6)->get(),
                ]);
        }
    }

    public function filterPeople(string $name)
    {
        return Person::query()->where(function ($query) use ($name) {
            $query->where('first_name', 'like', "%$name%");
            $query->orWhere('last_name', 'like', "%$name%");
        });
    }

    public function filterUsers(string $name, string $sort_alpha = "asc", string $sort_date = "asc")
    {
        return User::query()->where(function ($query) use ($name) {
            $query->where('username', 'like', "%$name%");
        })
            ->orderBy('username', $sort_alpha)
            ->orderBy('created_at', $sort_date);
    }

    public function filterMovies(string $name)
    {
        return Movie::query()->where(function ($query) use ($name) {
            $query->where('title', 'like', "%$name%");
            $query->orWhere('synopsis', 'like', "%$name%");
        });
    }
}
