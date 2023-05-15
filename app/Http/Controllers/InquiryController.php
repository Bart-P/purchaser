<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Inertia\Inertia;
use Illuminate\Http\Request;

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

    function edit($id)
    {
        $inquiry = Inquiry::find($id);

        return Inertia::render('Inquiries/Edit', [
            'inquiry' => $inquiry,
        ]);
    }

    function update(Request $request)
    {
        $inquiry = Inquiry::find($request->id);
        $inquiry->fill($request->query());
        if ($inquiry->save()) {
            return redirect()->back()->with('notification', [
                'message' => 'Anfrage wurde geändert!',
                'type'    => 'success',
            ]);
        }

        return redirect()->back()->with('notification', [
            'message' => 'Es ist ein Fehler aufgetreten! Anfrage konnte nicht gespeichert werden.',
            'type'    => 'danger',
        ]);
    }

    function destroy(Request $request)
    {
        Inquiry::destroy($request->id);

        return redirect('inquiries')->with('notification', [
            'message' => 'Anfrage gelöscht!',
            'type'    => 'warning',
        ]);
    }
}