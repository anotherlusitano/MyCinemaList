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
}
