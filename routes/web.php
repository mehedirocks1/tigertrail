<?php

use Illuminate\Support\Facades\Route;
use Modules\Events\App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactMessageController;;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HomeController;

// This single route handles the data fetching AND the view
Route::get('/', [EventRegistrationController::class, 'index'])->name('home');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/contact', [ContactMessageController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::post('/suggestion', function (Illuminate\Http\Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20', // ভ্যালিডেশন যোগ করা হলো
        'message' => 'required|string',
    ]);

    App\Models\Suggestion::create($data);

    return back()->with('success', 'Thank you! Your suggestion has been received.');
})->name('suggestion.store');

Route::get('/terms-and-conditions', [HomeController::class, 'terms'])->name('terms');