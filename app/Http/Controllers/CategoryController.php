<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function store(Request $request)
    {
        $category = Category::create(
            $request->validate(
                [
                    'name'  => ['required', 'max:50'],
                    'color' => ['required', 'max:50'],
                ]
            )
        );

        if ($category) {
            return redirect()->back()->with('notification', [
                'message' => 'Kategorie hinzugefügt!',
                'type'    => 'success',
            ]);
        }

        return redirect()->back()->with('notification', [
            'message' => 'Es ist ein Fehler aufgetreten! Kategorie wurde nicht gespeichert.',
            'type'    => 'danger',
        ]);
    }

    function destroy($id)
    {
        if (Category::destroy($id)) {
            return redirect()->back()->with('notification', [
                'message' => 'Kategorie gelöscht!',
                'type'    => 'success',
            ]);
        };

        return redirect()->back()->with('notification', [
            'message' => 'Es ist ein Fehler aufgetreten! Kategorie konnte nicht gelöscht werden.',
            'type'    => 'danger',
        ]);
    }

    function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->fill($request->query());
        if ($category->save()) {
            return redirect()->back()->with('notification', [
                'message' => 'Kategorie änderungen wurden gespeichert!',
                'type'    => 'success',
            ]);
        }

        return redirect()->back()->with('notification', [
            'message' => 'Es ist ein Fehler aufgetreten! Kategorie konnte nicht gespeichert werden.',
            'type'    => 'danger',
        ]);
    }
}
