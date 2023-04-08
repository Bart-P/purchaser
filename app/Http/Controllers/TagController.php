<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function store(Request $request)
    {
        $tag = Tag::create(
            [
                'name' => $request->name,
                'category_id' => $request->categoryId,
            ]
        );

        if ($tag) {
            return redirect()->back()->with('notification', [
                'message' => 'Tag hinzugefügt!',
                'type'    => 'success',
            ]);
        }

        return redirect()->back()->with('notification', [
            'message' => 'Es ist ein Fehler aufgetreten, Tag wurde nicht hinzugefügt!',
            'type'    => 'danger',
        ]);
    }

    function destroy($id)
    {
        if (Tag::destroy($id)) {
            return redirect()->back()->with('notification', [
                'message' => 'Tag gelöscht!',
                'type'    => 'success',
            ]);
        };

        return redirect()->back()->with('notification', [
            'message' => 'Es ist ein Fehler aufgetreten! Tag konnte nicht gelöscht werden.',
            'type'    => 'danger',
        ]);
    }

    function update(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->name = $request->name;
        if ($tag->save()) {
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
