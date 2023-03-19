<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{
    /**
     * Returns an array of address objects with set supplier id
     *
     * @param $addresses
     * @param $supplierId
     * @return array
     *
     */
    public static function getArrayOfAddressObjects($addresses, $supplierId): array
    {
        $addressesArray = [];
        foreach ($addresses as $address) {
            $address = new Address(
                [
                    'supplier_id' => $supplierId,
                    'type'        => $address['type'],
                    'name1'       => $address['name1'],
                    'name2'       => $address['name2'],
                    'name3'       => $address['name3'],
                    'street'      => $address['street'],
                    'street_nr'   => $address['street_nr'],
                    'city_code'   => $address['city_code'],
                    'city'        => $address['city'],
                    'country'     => $address['country'],
                    'phone'       => $address['phone'],
                ]
            );
            $addressesArray[] = $address;
        };
        return $addressesArray;
    }

    function edit($id)
    {
        $address = Address::find($id);

        return Inertia::render('Address/Edit', [
            'address' => $address,
        ]);
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'supplier_id' => 'required|integer',
                'type'        => 'required|max:255',
                'name1'       => 'required|max:255',
                'name2'       => 'nullable|max:255',
                'name3'       => 'nullable|max:255',
                'street'      => 'required|max:255',
                'street_nr'   => 'required|max:255',
                'city_code'   => 'required|max:255',
                'city'        => 'required|max:255',
                'country'     => 'required|max:255',
                'phone'       => 'nullable|max:255',
            ]
        );

        Supplier::find($request->supplier_id)->touch();

        Address::create(
            [
                'supplier_id' => $request->supplier_id,
                'type'        => $request->type,
                'name1'       => $request->name1,
                'name2'       => $request->name2,
                'name3'       => $request->name3,
                'street'      => $request->street,
                'street_nr'   => $request->street_nr,
                'city_code'   => $request->city_code,
                'city'        => $request->city,
                'country'     => strtoupper($request->country),
                'phone'       => $request->phone,
            ]
        );

        return redirect()->back()->with('notification', [
            'message' => 'Addresse gespeichert!',
            'type'    => 'success',
        ]);

    }

    function destroy(Request $request)
    {
        Address::destroy($request->id);

        return redirect()->back()->with('notification', [
            'message' => 'Addresse gelöscht!',
            'type'    => 'warning',
        ]);
    }

    function update(Request $request)
    {
        $address = Address::find($request->id);
        $address->fill($request->query());
        $address->country = strtoupper($address->country);
        $address->save();

        // ADD FAILED MESSAGE
        return redirect()->route('suppliers.edit', $address->supplier_id)->with('notification', [
            'message' => 'Adresse geändert!',
            'type'    => 'success',
        ]);
    }
}