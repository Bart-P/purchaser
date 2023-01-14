<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuppliersController extends Controller
{
    function index(Request $request) {
        return Inertia::render('Suppliers/Suppliers', [
            'suppliers' => Supplier::when($request->search, function ($query, $search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                      ->orWhere('email', 'LIKE', '%'.$search.'%');
            })->paginate(15)
              ->withQueryString()
        ]);
    }

    function create() {
        return Inertia::render('Suppliers/SuppliersCreate');
    }
}