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
}
