<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InquiryController extends Controller
{
    function index()
    {
        return Inertia::render('Inquiries/Inquiries', [
            'inquiries' => Inquiry::all(),
        ]);
    }

    function show($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiryProducts = $inquiry->products()->get()->map(function ($prod) {
            $prodPrices = $prod->productPrices()->get();
            $prod->prices = $prodPrices;
            return $prod;
        });
        // TODO - need a relation between inquiry and inquiryRequest, as well as
        // between product and inquiryRequest... 
        // $inquryRequests = 

        return Inertia::render('Inquiries/Show', [
            'inquiry' => $inquiry,
            'products' => $inquiryProducts,
        ]);
    }
}
