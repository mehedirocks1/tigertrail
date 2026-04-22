<?php

namespace App\Http\Controllers;

use Modules\Events\App\Models\Event; 
use App\Models\HeroSlide;
use App\Models\Reward;
use App\Models\RaceKit;
use App\Models\Testimonial;
use App\Models\Memory; // GalleryImage এর বদলে Memory ইমপোর্ট করলাম
use App\Models\Sponsor;
use App\Models\Brochure; // নতুন যোগ করা হলো
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Flagship এবং অন্যান্য ইভেন্ট
        $featuredEvent = Event::where('is_flagship', true)->first();
        $otherEvents = Event::where('is_flagship', false)->get();

        return view('frontend.index', [
            'featuredEvent' => $featuredEvent,
            'otherEvents'   => $otherEvents,
            
            // আমরা যে Scope গুলো মডেলে লিখেছিলাম সেগুলো ব্যবহার করা হয়েছে
            'slides'        => HeroSlide::where('is_active', true)->orderBy('order')->get(),
            'rewards'       => Reward::where('is_active', true)->orderBy('order')->get(),
            'kits'          => RaceKit::where('is_active', true)->orderBy('order')->get(),
            
            // টেস্টিমোনিয়াল - লেটেস্ট ৩টি
            'testimonials'  => Testimonial::where('is_approved', true)->latest()->take(3)->get(),
            
            // মেমোরি সেকশন (Slider)
            'memories'      => Memory::where('is_active', true)->orderBy('order')->get(),

            // ব্রোশিওর (সবচেয়ে নতুন অ্যাক্টিভ ফাইলটি)
            'brochure'      => Brochure::where('is_active', true)->latest()->first(),
            
            // স্পন্সর - আমরা মাইগ্রেশনে 'type' এবং 'sort_order' ব্যবহার করেছি
            'sponsors'      => Sponsor::where('is_active', true)
                                ->orderBy('sort_order') // 'order' এর বদলে 'sort_order'
                                ->get()
                                ->groupBy('type'),      // 'tier' এর বদলে 'type'
        ]);
    }


public function terms()
    {
        // এটি resources/views/frontend/terms.blade.php ফাইলটিকে লোড করবে
        return view('frontend.terms');
    }






}