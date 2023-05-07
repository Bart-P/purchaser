<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\InquiryRequest;
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

        $inquiryRequests = $inquiry
            ->inquiryRequests()
            ->select('inquiry_requests.*', 'suppliers.name')
            ->join('suppliers', 'suppliers.id', '=', 'inquiry_requests.supplier_id')
            ->get();

        return Inertia::render('Inquiries/Show', [
            'inquiry' => $inquiry,
            'products' => $inquiryProducts,
            'inquiryRequests' => $inquiryRequests,
        ]);
    }
}
