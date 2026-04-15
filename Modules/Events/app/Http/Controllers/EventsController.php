<?php

namespace Modules\Events\App\Http\Controllers;
use Modules\Events\App\Models\Event;
use Modules\Events\App\Models\EventResult;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('events::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('events::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('events::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}





public function results(Request $request)
    {
        // ড্রপডাউনের জন্য সব ইভেন্ট এবং ইউনিক ক্যাটাগরিগুলো আনছি
        $events = Event::select('id', 'title')->get();
        $categories = EventResult::select('category')->whereNotNull('category')->distinct()->pluck('category');

        // রেজাল্ট কুয়েরি শুরু
        $query = EventResult::query();

        // ইভেন্ট ফিল্টার
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        // ক্যাটাগরি ফিল্টার
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // নাম বা BIB নম্বর দিয়ে সার্চ
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('athlete_name', 'like', "%{$searchTerm}%")
                  ->orWhere('bib_number', 'like', "%{$searchTerm}%");
            });
        }

        // র‍্যাংক অনুযায়ী ছোট থেকে বড় সাজানো এবং প্যাজিনেট করা (প্রতি পেজে ১০ জন)
        $results = $query->orderBy('rank', 'asc')->paginate(10);

        return view('events::results', compact('events', 'categories', 'results'));
    }






}
