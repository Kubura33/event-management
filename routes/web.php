<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventMainController;
use App\Http\Controllers\EventRegistrationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [EventMainController::class, 'events'])->name('home');
Route::get('/event/{event}', [EventMainController::class, 'event'])->name('event');
Route::get('/browse-events', [EventMainController::class, 'browseEvents'])->name('browse-events');
Route::post('/register-for-event/{event}', [EventRegistrationController::class, 'register'])->name('event.registration');
Route::get('/r/{attendee}/cancel', [EventRegistrationController::class, 'cancel'])
    ->name('registrations.cancel')
    ->middleware('signed');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('events', EventController::class)->only(['index', 'create', 'edit', 'show', 'store',  'update', 'destroy']);
});
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
