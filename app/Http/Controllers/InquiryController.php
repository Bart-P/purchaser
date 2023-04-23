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
}