<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{
    function edit($id)
    {
        $person = Person::find($id);

        return Inertia::render('Person/Edit', [
            'person' => $person
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
    }

    function destroy($id)
    {
        Person::destroy($id);

        return redirect()->back();
    }

    function update(Request $request)
    {
        $person = Person::find($request->id);
        $person->fill($request->query());
        $person->save();

        return redirect()->route('suppliers.edit', $request->id)->with('notification', ['message' => 'Person geändert!']);
    }
}