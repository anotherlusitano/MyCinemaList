<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\GenresOfMovie;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Staff;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function index()
    {
        return view('backoffice.index');
    }

    public function add_people()
    {
        return view('backoffice.staff.add');
    }

    public function create_person()
    {
        request()->validate([
            'first_name' => ['min:3', 'max:25', 'required'],
            'last_name' => ['min:3', 'max:25', 'required'],
            'birthday' => ['date', 'required'],
            'description' => ['nullable', 'max:255'],
            'picture' => ['nullable', 'image'],
        ]);

        if (request()->hasFile('picture')) {
            $path = request()->file('picture')->store('people', 'public');
            $picture = '/storage/' . $path;
        } else {
            $picture = 'person.png';
        }

        Person::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'birthday' => request('birthday'),
            'description' => request('description'),
            'picture' => $picture,
        ]);

        return redirect()->back();
    }

    public function staff(Request $request)
    {
        $query = $request->query('query') ?? '';

        $sort = $request->query('sort') ?? 'first_name|asc';

        return view('backoffice.staff', [
            'people' => $this->filterPeople($query, $sort)->paginate(8),
        ]);
    }

    public function filterPeople(string $name, string $sort = "first_name|asc")
    {
        [$field, $direction] = explode('|', $sort);

        return Person::query()->where(function ($query) use ($name) {
            $query->where('first_name', 'like', "%$name%");
            $query->orWhere('last_name', 'like', "%$name%");
        })->orderBy($field, $direction);
    }

    public function destroy_person(Person $person)
    {
        $person->delete();

        return redirect()->back();
    }

    public function destroy_staff(Staff $staff)
    {
        $staff->delete();

        return redirect()->back();
    }

    public function edit_person(Person $person)
    {
        return view('backoffice.staff.edit', [
            'person' => $person,
        ]);
    }

    public function staff_roles(Person $person)
    {
        return view('backoffice.staff.roles', [
            'person' => $person,
            'staff' => $person->staff()->paginate(8)
        ]);
    }

    public function add_roles(Request $request, Person $person)
    {
        $title = $request->query('query') ?? '';
        $movies = Movie::query()->where(function ($query) use ($title, $person) {
            foreach ($person->staff as $staff) {
                $query->where('title', 'like', "%$title%");
                $query->whereNot('id', $staff->movie->id);
            }
        })->paginate(6);

        return view('backoffice.staff.add_roles', [
            'movies' => $movies,
            'person' => $person
        ]);
    }

    public function create_role()
    {
        request()->validate([
            'movie_id' => ['required', 'numeric'],
            'person_id' => ['required', 'numeric'],
            'role' => ['required', 'min:3', 'max:50']
        ]);

        Staff::create([
            'movie_id' => request('movie_id'),
            'person_id' => request('person_id'),
            'role' => request('role')
        ]);

        return redirect()->back();
    }

    public function update_person(Person $person)
    {
        request()->validate([
            'first_name' => ['min:3', 'max:25', 'required'],
            'last_name' => ['min:3', 'max:25', 'required'],
            'birthday' => ['date', 'required'],
            'description' => ['nullable', 'max:255'],
            'picture' => ['image'],
        ]);

        $picture = $person->picture;

        // person.png is the default picture
        if (request('picture') && $person->picture !== 'person.png') {

            // Will delete the previous picture from the storage
            unlink(public_path($person->picture));
        }

        if (request()->hasFile('picture')) {
            $path = request()->file('picture')->store('people', 'public');
            $picture = '/storage/' . $path;
        }

        $person->update([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'birthday' => request('birthday'),
            'description' => request('description'),
            'picture' => $picture,
        ]);

        return redirect()->back();
    }

    public function update_staff(Staff $staff)
    {
        request()->validate([
            'role' => ['min:3', 'max:50', 'required'],
        ]);

        $staff->update([
            'role' => request('role'),
        ]);

        return redirect()->back();
    }


    // --------------------- MOVIES ------------------------
    public function movies(Request $request)
    {
        $query = $request->query('query') ?? '';

        $sort = $request->query('sort') ?? 'title|asc';
        $status = $request->query('status') ?? '';
        $genre = $request->query('genre') ?? '';
        $rating = $request->query('rating') ?? '';

        return view('backoffice.movies', [
            'movies' => $this->filterMovies($query, $sort, $status, $rating, $genre)->paginate(8),
        ]);
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
                    $query->whereHas('genre', function ($query) use ($genre) {
                        $query->where('name', $genre);
                    });
                });
            })
            ->orderBy($field, $direction);
    }

    public function destroy_movie(Movie $movie)
    {
        $movie->delete();

        return redirect()->back();
    }

    public function edit_movie(Movie $movie)
    {
        return view('backoffice.movies.edit', [
            'movie' => $movie,
        ]);
    }

    public function update_movie(Movie $movie)
    {
        request()->validate([
            'title' => ['min:3', 'max:50'],
            'synopsis' => ['max:1250', 'nullable'],
            'release_year' => ['numeric', 'min:1900', 'max:2067', 'nullable'],
            'duration' => ['numeric', 'min:20', 'max:360', 'nullable'],
            'rating' => 'required|in:all ages,kids,teens,adults',
            'status' => 'required|in:released,unreleased,cancelled',
            'picture' => ['nullable', 'image'],
        ]);

        $picture = $movie->picture;

        // movie.png is the default picture
        if (request('picture') && $movie->picture !== 'movie.png') {

            // Will delete the previous picture from the storage
            unlink(public_path($movie->picture));
        }

        if (request()->hasFile('picture')) {
            $path = request()->file('picture')->store('movies', 'public');
            $picture = '/storage/' . $path;
        }

        $movie->update([
            'title' => request('title'),
            'synopsis' => request('synopsis'),
            'release_year' => request('release_year'),
            'duration' => request('duration'),
            'rating' => request('rating'),
            'status' => request('status'),
            'picture' => $picture,
        ]);

        return redirect()->back();
    }

    public function genres(Movie $movie)
    {
        $genres = Genre::query()->where(function ($query) use ($movie) {
            foreach ($movie->genres as $genre) {
                $query->whereNot('id', $genre->genre_id);
            }
        })->get();

        return view('backoffice.movies.genres', [
            'movie' => $movie,
            'genres' => $movie->genres()->get(),
            'remaining_genres' => $genres
        ]);
    }

    public function add_genre(Movie $movie)
    {
        request()->validate([
            'genre' => ['required', 'numeric'],
        ]);

        GenresOfMovie::create([
            'movie_id' => $movie->id,
            'genre_id' => request('genre'),
        ]);

        return redirect()->back();
    }

    public function destroy_genre_of_movie(GenresOfMovie $genre)
    {
        $genre->delete();

        return redirect()->back();
    }

    public function edit_genres()
    {
        return view('backoffice.genres.edit', [
            'genres' => Genre::paginate(8),
        ]);
    }

    public function create_genre()
    {
        request()->validate([
            'genre' => ['required', 'min:3', 'max:40']
        ]);

        Genre::create([
            'name' => request('genre')
        ]);

        return redirect()->back();
    }

    public function destroy_genre(Genre $genre)
    {
        $genre->delete();

        return redirect()->back();
    }
}
