<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\Reward;
use App\Models\RaceKit;
use App\Models\Testimonial;
use App\Models\GalleryImage;
use App\Models\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index()
    {
        // Your existing Event logic goes here
        $featuredEvent = Event::where('is_featured', true)->first();
        $otherEvents = Event::where('is_featured', false)->get();

        return view('frontend.index', [
            'featuredEvent' => $featuredEvent,
            'otherEvents' => $otherEvents,
            'slides' => HeroSlide::where('is_active', true)->orderBy('order')->get(),
            'rewards' => Reward::where('is_active', true)->orderBy('order')->get(),
            'kits' => RaceKit::where('is_active', true)->orderBy('order')->get(),
            'testimonials' => Testimonial::where('is_approved', true)->latest()->take(3)->get(),
            'gallery' => GalleryImage::where('is_active', true)->orderBy('order')->get(),
            
            // Grouping sponsors by tier so they are easy to loop through in the view
            'sponsors' => Sponsor::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->groupBy('tier'), 
        ]);
    }
}
