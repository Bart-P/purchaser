<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{

    /**
     * Returns an array of Person objects with set supplier id
     *
     * @param $persons
     * @param $supplierId
     * @return array
     *
     */
    public static function getArrayOfPersonObjects($persons, $supplierId)
    {
        $personsArray = [];
        foreach ($persons as $person) {
            $person = new Person(
                [
                    'supplier_id' => $supplierId,
                    'type'        => $person['type'],
                    'gender'      => $person['gender'],
                    'first_name'  => $person['first_name'],
                    'last_name'   => $person['last_name'],
                    'position'    => $person['position'],
                    'phone1'      => $person['phone1'],
                    'phone2'      => $person['phone2'],
                    'email1'      => $person['email1'],
                    'email2'      => $person['email2'],

                ]
            );
            $personsArray[] = $person;
        };
        return $personsArray;
    }

    function edit($id)
    {
        $person = Person::find($id);

        return Inertia::render('Person/Edit', [
            'person' => $person,
        ]);
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'supplier_id' => 'required|integer',
                'type'        => 'required|max:255',
                'gender'      => 'required|max:20',
                'first_name'  => 'required|max:255',
                'last_name'   => 'required|max:255',
                'position'    => 'nullable|max:255',
                'phone1'      => 'nullable|max:255',
                'phone2'      => 'nullable|max:255',
                'email1'      => 'nullable|max:255',
                'email2'      => 'nullable|max:255',
            ]);

        Person::create(
            [
                'supplier_id' => $request->supplier_id,
                'type'        => $request->type,
                'gender'      => $request->gender,
                'first_name'  => $request->first_name,
                'last_name'   => $request->last_name,
                'position'    => $request->position,
                'phone1'      => $request->phone1,
                'phone2'      => $request->phone2,
                'email1'      => $request->email1,
                'email2'      => $request->email2,
            ]);


        return redirect()->route('suppliers.edit', $request->supplier_id)->with('notification', [
            'message' => 'Neue Person erfolgreich erstellt!',
            'type'    => 'success',
        ]);
    }

    function destroy($id)
    {
        Person::destroy($id);

        return redirect()->back()->with('notification', [
            'message' => 'Person wurde aus der Datenbank gelöscht!',
            'type'    => 'success',
        ]);
    }

    function update(Request $request)
    {
        $person = Person::find($request->id);
        $person->fill($request->query());
        $person->save();

        return redirect()->route('suppliers.edit', $request->supplier_id)->with(
            'notification',
            [
                'message' => 'Person geändert!',
                'type'    => 'success',
            ],
        );
    }
}