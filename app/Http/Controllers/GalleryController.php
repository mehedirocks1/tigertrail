<?php

namespace App\Http\Controllers;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
public function index()
    {
        // Fetch all active gallery images, ordered by sort_order or latest
        $photos = Gallery::active()
            ->orderBy('sort_order')
            ->latest()
            ->get();

        // Extract unique categories dynamically for the UI filter buttons
        $categories = Gallery::active()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('frontend.gallery', compact('photos', 'categories'));
    }
}
