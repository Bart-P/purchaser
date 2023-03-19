<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
            $supplierCategoryJunction = $supplier->categoryJunctions()->get();
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
                $addressesArray = AddressController::getArrayOfAddressObjects($request->addresses, $supplier->id);
            };

            if ($request->persons) {
                $personsArray = PersonController::getArrayOfPersonObjects($request->persons, $supplier->id);
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

        $rawJunctions = $supplier->categoryJunctions()->get();

        /**
         * First get category ids from the request,
         * then get an array with just category ids out of the supplier junctions
         * then compare both, if something is missing either delete or create a junction
         */
        $requestCategoryIds = array_map(function ($cat) {
            return $cat['id'];
        }, array_values($request->categories));

        $junctionIds = array_map(function ($jun) {
            return $jun['category_id'];
        }, array_values($rawJunctions->toArray()));

        $junctionsToCreate = array_diff($requestCategoryIds, $junctionIds);
        $junctionsToDelete = array_diff($junctionIds, $requestCategoryIds);


        foreach ($junctionsToCreate as $category) {
            SupplierCategoryJunction::create(
                [
                    'supplier_id' => $supplier->id,
                    'category_id' => $category,
                ]);
        }

        foreach ($junctionsToDelete as $category) {
            SupplierCategoryJunction::destroy($rawJunctions->where('category_id', 'like', $category));
        }

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
}