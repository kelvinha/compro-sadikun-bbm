<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Product;

class TransportirController extends Controller
{
    public function index()
    {
        // Get active products
        $transports = Product::where('status', 'active')->where('category_id', 9)->get();

        return view('landing.transportir', compact('transports'));
    }
}
