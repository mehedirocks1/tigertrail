<?php

use Illuminate\Support\Facades\Route;
use Modules\Events\App\Http\Controllers\EventsController; // <-- Capital A
use Modules\Events\App\Http\Controllers\EventRegistrationController; //

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. SPECIFIC PUBLIC ROUTES (These must go FIRST!)
Route::get('/events/register', [EventRegistrationController::class, 'show'])->name('events.register.form');
Route::post('/events/register', [EventRegistrationController::class, 'store'])->name('events.register.submit');

// Public list of events
Route::get('/events', [EventRegistrationController::class, 'index'])->name('events.public.index');

// 2. ADMIN / BACKEND ROUTES (These go LAST)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('events', EventsController::class)->names('events');
});