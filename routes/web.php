<?php

use Illuminate\Support\Facades\Route;
use Modules\Events\App\Http\Controllers\EventRegistrationController;

// This single route handles the data fetching AND the view
Route::get('/', [EventRegistrationController::class, 'index'])->name('home');