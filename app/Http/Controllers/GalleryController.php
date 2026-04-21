<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage; // Switched to the correct model
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Fetch all active gallery images, ordered by your Filament 'order' field
        $images = GalleryImage::active()
            ->orderBy('order')
            ->latest()
            ->get();

        // Extract unique categories dynamically for the UI filter buttons
        // Added 'whereNotNull' so empty categories don't break the buttons
        $categories = GalleryImage::active()
            ->whereNotNull('category')
            ->pluck('category')
            ->unique()
            ->values();

        return view('frontend.gallery', compact('images', 'categories'));
    }
}