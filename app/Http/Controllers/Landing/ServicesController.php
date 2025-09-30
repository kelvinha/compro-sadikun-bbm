<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        // Get Gallery
        $medias = Media::where('disk', 'public')
            ->where('category', 'general')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('landing.services', compact('medias'));
    }
}
