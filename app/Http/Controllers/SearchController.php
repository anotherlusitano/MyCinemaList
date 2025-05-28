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
                $sort = $request->query('sort') ?? 'first_name|asc';

                return view('search.people', [
                    'people' => $this->filterPeople($query, $sort)->paginate(8),
                ]);
            case 'movies':
                $sort = $request->query('sort') ?? 'title|asc';
                $status = $request->query('status') ?? '';
                $genre = $request->query('genre') ?? '';
                $rating = $request->query('rating') ?? '';

                return view('search.movies', [
                    'movies' => $this->filterMovies($query, $sort, $status, $rating, $genre)->paginate(8),
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

    public function filterPeople(string $name, string $sort = "first_name|asc")
    {
        [$field, $direction] = explode('|', $sort);

        return Person::query()->where(function ($query) use ($name) {
            $query->where('first_name', 'like', "%$name%");
            $query->orWhere('last_name', 'like', "%$name%");
        })->orderBy($field, $direction);
    }

    public function filterUsers(string $name, string $sort_alpha = "asc", string $sort_date = "asc")
    {
        return User::query()->where(function ($query) use ($name) {
            $query->where('username', 'like', "%$name%");
        })
            ->orderBy('username', $sort_alpha)
            ->orderBy('created_at', $sort_date);
    }

    public function filterMovies(string $name, string $sort = "title|asc", string $status = '', string $rating = '', string $genre = '')
    {
        [$field, $direction] = explode('|', $sort);

        return Movie::query()->where(function ($query) use ($name) {
            $query->where('title', 'like', "%$name%");
            $query->orWhere('synopsis', 'like', "%$name%");
        })
            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($rating !== '', function ($query) use ($rating) {
                $query->where('rating', $rating);
            })
            ->when($genre !== '', function ($query) use ($genre) {
                $query->whereHas('genres', function ($query) use ($genre) {
                    $query->where('name', $genre);
                });
            })
            ->orderBy($field, $direction);
    }
}
