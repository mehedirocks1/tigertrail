<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
// Show the contact form
    public function index()
    {
        return view('frontend.contact');
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save to database
        ContactMessage::create($validated);

        // Redirect back with a success message (which your Blade file is already set up to display)
        return redirect()->back()->with('success', 'Thank you for reaching out! We will get back to you shortly.');
    }
}
