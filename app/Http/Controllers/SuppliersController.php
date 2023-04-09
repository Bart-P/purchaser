<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
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
                ->when($request->filterCategories, function ($query, $filterCategories) {
                    $query->whereHas('categories', function ($query) use ($filterCategories) {
                        $query->whereIn('id',  explode(',', $filterCategories));
                    }, '=', count(explode(',', $filterCategories)));
                })
                ->when($request->filterTags, function ($query, $filterTags) {
                    $query->whereHas('tags', function ($query) use ($filterTags) {
                        $query->whereIn('id',  explode(',', $filterTags));
                    }, '=', count(explode(',', $filterTags)));
                })
                ->orderBy('updated_at', 'DESC')
                ->paginate(15)
                ->withQueryString(),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $this->updateTagsWithColors($tags, $categories);

        return Inertia::render('Suppliers/SuppliersCreate', [
            'categories' => $categories,
            'tags' => $tags,
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

        $this->updateTagsWithColors($tags, $categories);

        if ($supplier) {
            $addresses = $supplier->addresses()->get();
            $persons = $supplier->persons()->get();
            $supplierTags = $supplier->tags()->get();
            $supplierCategories = $supplier->categories()->get();

            $this->updateTagsWithColors($supplierTags, $categories);
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

    private function updateTagsWithColors(Collection $tags, $categories)
    {
        $tags->map(function ($tag) use ($categories) {
            return $tag->color = $categories->find($tag->category_id)->color;
        });
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
        $supplier->updateCategoryPivot($this->getCategoryIds($request->categories));
        $supplier->updateTagPivot($this->getTagIds($request->tags));

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

        if ($supplier->touch()) {

            $supplier->updateCategoryPivot($this->getCategoryIds($request->categories));
            $supplier->updateTagPivot($this->getTagIds($request->tags));

            return redirect()->route('suppliers')->with('notification', [
                'message' => 'Änderungen wurden gespeichert!',
                'type'    => 'success',
            ]);
        };

        return redirect()->route('suppliers')->with('notification', [
            'message' => 'Es ist ein Fehler aufgetreten, Änderungen am Lieferanten wurden nicht gespeichert!',
            'type'    => 'danger',
        ]);
    }

    function getCategoryIds($categories)
    {
        return array_map((function ($category) {
            return $category['id'];
        }), $categories);
    }

    function getTagIds($tags)
    {
        return array_map((function ($tag) {
            return $tag['id'];
        }), $tags);
    }
}
