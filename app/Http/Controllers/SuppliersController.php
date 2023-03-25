<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Tag;
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
        $tags = Tag::all();
        $supplierTags = [];

        if ($supplier) {
            $addresses = $supplier->addresses()->get();
            $persons = $supplier->persons()->get();
            $supplierCategoryJunction = $supplier->categoryJunctions()->get();
            $supplierTagJunction = $supplier->tagJunctions()->get();

            foreach ($categories as $category) {
                if ($supplierCategoryJunction->contains('category_id', $category->id)) {
                    $supplierCategories[] = $category;
                }
            };

            foreach ($tags as $tag) {
                $tag->color = $categories->find($tag->category_id)->color;
                if ($supplierTagJunction->contains('tag_id', $tag->id)) {
                    $supplierTags[] = $tag;
                }
            };
        }

        return Inertia::render('Suppliers/SuppliersEdit', [
            'supplier'           => $supplier,
            'addresses'          => $addresses,
            'persons'            => $persons,
            'supplierCategories' => $supplierCategories,
            'categories'         => $categories,
            'tags'               => $tags,
            'supplierTags'       => $supplierTags,
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

        if (!$supplier) {
            return redirect()->route('suppliers')->with('notification', [
                'message' => 'Fehler - Lieferant konnte nicht hinzugefügt werden!',
                'type'    => 'danger',
            ]);
        }

        $supplier->saveAddresses($request->addresses);
        $supplier->savePersons($request->persons);
        $supplier->createCategoryJunctions($request->categories);

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
        $supplier->updateCategoryJunctions($request->categories);

        // TODO ADD FAILED MESSAGE
        return redirect()->route('suppliers')->with('notification', [
            'message' => 'Änderung gespeichert!',
            'type'    => 'success',
        ]);
    }
}
