<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function index()
    {
        return view('backoffice.index');
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

    public function edit(Person $person)
    {
        $movies_person_participated = $person->staff;

        return view('backoffice.staff.edit', [
            'person' => $person,
            'movies_person_participated' => $movies_person_participated
        ]);
    }

    public function update(Person $person)
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
}
