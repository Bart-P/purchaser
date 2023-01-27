<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuppliersController extends Controller
{
    function index(Request $request)
    {
        return Inertia::render('Suppliers/Suppliers',
                               [
                                   'suppliers' => Supplier::when($request->search, function ($query, $search) {
                                       $query->where('name', 'LIKE', '%' . $search . '%')
                                             ->orWhere('email', 'LIKE', '%' . $search . '%');
                                   })->latest()
                                                          ->paginate(15)
                                                          ->withQueryString(),
                               ]);
    }

    function create()
    {
        return Inertia::render('Suppliers/SuppliersCreate');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name'  => ['required', 'max:50'],
                'email' => ['required', 'max:50'],
            ]);

        $supplier = Supplier::create(
            [
                'name'  => $request->name,
                'email' => $request->email,
            ]);

        if ($supplier) {
            $addressesArray = $this->getArrayOfAddressObjects($request->addresses, $supplier->id);
            $this->storeAddressesAndOrPersons($supplier, $addressesArray);
        }

        // TODO set up error or success notification on route
        return redirect()->route('suppliers');
    }

    function storeAddressesAndOrPersons(Supplier $supplier, $addresses = [[]], $persons = [[]])
    {
        if (count($addresses)) {
            $supplier->addresses()->saveMany($addresses);
        }
    }

    /**
     * @param $addresses
     * @param $supplier
     * @return array
     */
    public function getArrayOfAddressObjects($addresses, $supplierId): array
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
                    'street_nr'   => $address['streetNr'],
                    'city_code'   => $address['cityCode'],
                    'city'        => $address['cityCode'],
                    'country'     => $address['cityCode'],
                    'phone'       => $address['phone'],
                ]

            );
            $addressesArray[] = $address;
        };
        return $addressesArray;
    }
}