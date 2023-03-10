<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Person;
use App\Models\Supplier;
use App\Models\SupplierCategoryJunction;
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
        return Inertia::render('Suppliers/SuppliersCreate', [
            'categories' => Category::all(),
        ]);
    }

    function edit($id)
    {
        $supplier = Supplier::find($id);
        $addresses = [];
        $persons = [];
        $categories = Category::all();
        $supplierCategories = [];

        if ($supplier) {
            $addresses = $supplier->addresses()->get();
            $persons = $supplier->persons()->get();
            $supplierCategoryJunction = SupplierCategoryJunction::all()->where('supplier_id', 'like', $id)->values();
            foreach ($categories as $category) {
                if ($supplierCategoryJunction->contains('category_id', $category->id)) {
                    $supplierCategories[] = $category;
                }
            };
        }

        return Inertia::render('Suppliers/SuppliersEdit', [
            'supplier'           => $supplier,
            'addresses'          => $addresses,
            'persons'            => $persons,
            'supplierCategories' => $supplierCategories,
            'categories'         => $categories,
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

            foreach ($request->categories as $category) {
                SupplierCategoryJunction::create(
                    [
                        'supplier_id' => $supplier->id,
                        'category_id' => $category['id'],
                    ]
                );
            }
        }

        // ADD FAILED MESSAGE
        return redirect()->route('suppliers')->with('notification', [
            'message' => 'Lieferant hinzugef??gt!',
            'type'    => 'success',
        ]);
    }

    function destroy($id)
    {
        Supplier::destroy($id);
        return redirect()->back()->with('notification', [
            'message' => 'Lieferant gel??scht!',
            'type'    => 'success',
        ]);
    }

    function update(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->update();

        //TODO figure out how to update all category junctions - we need to compare 2 arrays,
        // 1. delete the ones that are not in $request but are present in db
        // 2. do nothing if a junction is in both db and $request
        // 3. create a new junction if it is in $request but not in db

        // ADD FAILED MESSAGE
        return redirect()->route('suppliers')->with('notification', [
            'message' => '??nderung gespeichert!',
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
}