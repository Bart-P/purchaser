<?php

namespace App\Http\Controllers;

use App\Models\ProductDescription;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function storeDescription(Request $request)
    {
        $desc = $request->query();

        if ($desc['id'] !== 'temp') {
            return redirect()->back()->with('notification', [
                'message' => 'Es ist ein Fehler aufgetreten, die Beschreibung ist nicht als "neu" gekennzeichnet. Bitte versuchen Sie es erneut.',
                'type'    => 'danger',
            ]);
        }

        if (array_key_exists('supplier_id', $desc)) {
            $newDesc['supplier_id'] = intval($desc['supplier_id']);
        }

        $newDesc['product_id'] = $desc['product_id'];
        $newDesc['lang'] = $desc['lang'];
        $newDesc['is_main'] = intval($desc['is_main']);

        $newDesc['description'] = '';
        if ($desc['description']) $newDesc['description'] = $desc['description'];

        if (!ProductDescription::create($newDesc)) {
            return redirect()->back()->with('notification', [
                'message' => 'Fehler! Beschreibung, konnte nicht gespeichert werden!',
                'type'    => 'danger',
            ]);
        };

        return redirect()->back()->with('notification', [
            'message' => 'Beschreibung gespeichert!',
            'type'    => 'success',
        ]);
    }

    function destroyDescription(Request $request)
    {
        if (ProductDescription::destroy($request->query())) {
            return redirect()->back()->with('notification', [
                'message' => 'Beschreibung gelöscht!',
                'type'    => 'success',
            ]);
        };

        return redirect()->back()->with('notification', [
            'message' => 'Beschreibung konnte nicht gelöscht werden!',
            'type'    => 'danger',
        ]);
    }
}
