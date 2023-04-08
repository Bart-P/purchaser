<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function store(Request $request)
    {
        $tag = Tag::create(
            $request->validate(
                [
                    'name' => ['required', 'max:50'],
                    'category_id' => ['required'],
                ],
                [
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                ]
            )
        );

        if ($tag) {
            return redirect()->back()->with('notification', [
                'message' => 'Kategorie hinzugefügt!',
                'type'    => 'success',
            ]);
        }
    }
}
