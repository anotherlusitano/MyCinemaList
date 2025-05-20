<?php

namespace App\Http\Controllers;

use App\Models\Person;

class PersonController extends Controller
{
    public function show(Person $person)
    {
        $staff = $person->staff()->paginate(8);

        return view('people.show', [
            'person' => $person,
            'staff' => $staff,
        ]);
    }
}
