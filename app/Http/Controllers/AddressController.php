<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    function store(Request $request)
    {
        $request->validate(
            [
                'supplierId' => 'required|integer',
                'type'       => 'required|max:255',
                'name1'      => 'required|max:255',
                'name2'      => 'nullable|max:255',
                'name3'      => 'nullable|max:255',
                'street'     => 'required|max:255',
                'streetNr'   => 'required|max:255',
                'cityCode'   => 'required|max:255',
                'city'       => 'required|max:255',
                'country'    => 'required|max:255',
                'phone'      => 'nullable|max:255',
            ]
        );

        Supplier::find($request->supplierId)->touch();

        Address::create(
            [
                'supplier_id' => $request->supplierId,
                'type'        => $request->type,
                'name1'       => $request->name1,
                'name2'       => $request->name2,
                'name3'       => $request->name3,
                'street'      => $request->street,
                'street_nr'   => $request->streetNr,
                'city_code'   => $request->cityCode,
                'city'        => $request->city,
                'country'     => $request->country,
                'phone'       => $request->phone,
            ]
        );

        return redirect()->back();
    }

    function destroy(Request $request)
    {
        Address::destroy($request->id);

        return redirect()->back();
    }

    function destroy(Request $request)
    {
        Address::destroy($request->id);

        return redirect()->back();
    }
}