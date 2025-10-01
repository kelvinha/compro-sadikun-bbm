<?php

namespace App\Http\Controllers\Landing;

use App\Helpers\PageHelper;
use App\Helpers\ProductHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;

class TransportirController extends Controller
{
    public function index()
    {
        // Get active products
        $transports = Product::where('status', 'active')->where('category_id', 9)->get();

        return view('landing.transportir', compact('transports'));
    }

    public function show($slug)
    {
        // Find the product by slug
        $transportir = Product::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('landing.transportir-detail', compact('transportir'));
    }
}
