<?php

use Illuminate\Support\Facades\Route;
use Modules\Events\App\Http\Controllers\EventsController; // <-- Capital A
use Modules\Events\App\Http\Controllers\EventRegistrationController; //
use Modules\Events\App\Http\Controllers\SslcommerzController; //
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




    // ...
    Route::get('/results', [EventsController::class, 'results'])->name('events.results');




// New Module-Based SSL Commerz Routes
Route::controller(SslcommerzController::class)
    ->prefix('sslcommerz') 
    ->name('sslc.')
    ->group(function () {
        Route::post('/success', 'success')->name('success');
        Route::post('/failure', 'failure')->name('failure');
        Route::post('/cancel', 'cancel')->name('cancel');
        Route::post('/ipn', 'ipn')->name('ipn');
    });