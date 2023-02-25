<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Person;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuppliersController extends Controller
{
    function index(Request $request)
    {
        return Inertia::render('Suppliers/Suppliers', [
            'suppliers' => Supplier
                ::when($request->search, function ($query, $search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                          ->orWhere('email', 'LIKE', '%' . $search . '%');
                })
                ->orderBy('updated_at', 'DESC')
                ->paginate(15)
                ->withQueryString(),
        ]);
    }

    function create()
    {
        return Inertia::render('Suppliers/SuppliersCreate');
    }

    function edit($id)
    {
        $supplier = Supplier::find($id);
        $addresses = [];
        $persons = [];

        if ($supplier) {
            $addresses = $supplier->addresses()->get();
            $persons = $supplier->persons()->get();
        }

        return Inertia::render('Suppliers/SuppliersEdit', [
            'supplier'  => $supplier,
            'addresses' => $addresses,
            'persons'   => $persons,
        ]);
    }

    function store(Request $request)
    {
        $supplier = Supplier::create(
            $request->validate(
                [
                    'name'  => ['required', 'max:50'],
                    'email' => ['required', 'max:50'],
                ]
            )
        );

        if ($supplier) {
            $addressesArray = [];
            $personsArray = [];

            if ($request->addresses) {
                $addressesArray = $this->getArrayOfAddressObjects($request->addresses, $supplier->id);
            };

            if ($request->persons) {
                $personsArray = $this->getArrayOfPersonObjects($request->persons, $supplier->id);
            };

            $this->storeAddressesAndOrPersons($supplier, $addressesArray, $personsArray);
        }

        // ADD FAILED MESSAGE
        return redirect()->route('suppliers')->with('notification', [
            'message' => 'Lieferant hinzugefügt!',
            'type'    => 'success',
        ]);
    }

    function destroy($id)
    {
        Supplier::destroy($id);
        return redirect()->back()->with('notification', [
            'message' => 'Lieferant gelöscht!',
            'type'    => 'success',
        ]);
    }

    function update(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->update();

        // ADD FAILED MESSAGE
        return redirect()->route('suppliers')->with('notification', [
            'message' => 'Änderung gespeichert!',
            'type'    => 'success',
        ]);
    }

    private function storeAddressesAndOrPersons(Supplier $supplier, $addresses = [[]], $persons = [[]])
    {
        if (count($addresses)) {
            $supplier->addresses()->saveMany($addresses);
        }

        if (count($persons)) {
            $supplier->persons()->saveMany($persons);
        }
    }

    /**
     * Returns an array of Address objects and sets the supplier id for each
     *
     * @param $addresses
     * @param $supplierId
     * @return array
     *
     */
    private function getArrayOfAddressObjects($addresses, $supplierId): array
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


    /**
     * Returns an array of Person objects and sets the supplier id for each
     *
     * @param $persons
     * @param $supplierId
     * @return array
     *
     */
    private function getArrayOfPersonObjects($persons, $supplierId)
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

    // TODO figure out how to add Supplier categories + tags with an admin page to add and delete categories from admin Panel or simillar.
}