<?php
use App\Http\Controllers\EventController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('create/event/{eventType}', [EventController::class, 'index'])->name('event.create');
Route::post('/event/{event}/create-discount', [EventController::class, 'create_discount'])->name('event.create_discount');


Route::get('event/appearance/{event_id?}', function () {
    return Inertia::render('Appearance');
})->middleware(['auth', 'verified'])->name('appearance');

Route::get('event/ticket/{event_id?}', function () {
    return Inertia::render('CreateTicket');
})->middleware(['auth', 'verified'])->name('ticket');