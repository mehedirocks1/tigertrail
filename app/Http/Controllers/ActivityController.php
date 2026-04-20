<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\Activity;



class ActivityController extends Controller
{
public function index(Request $request)
    {
        // Load 4 activities at a time, ordered by your sort preference
        $activities = Activity::active()
            ->orderBy('sort_order', 'asc')
            ->paginate(4);

        // If the "Load More" JS button makes an AJAX request, send JSON back
        if ($request->ajax()) {
            return response()->json([
                'data' => $activities->items(),
                'next_page_url' => $activities->nextPageUrl(),
            ]);
        }

        // Otherwise, load the full page normally
        return view('frontend.activities', compact('activities'));
    }
}
