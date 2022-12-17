<?php

use App\Http\Controllers\EventTicketController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('event/ticket/{event_id?}', function () {
    return Inertia::render('CreateTicket', [
        'userId' => Auth::id()
    ]);
})->middleware(['auth', 'verified'])->name('ticket');


Route::get('event/tickets/{event_id?}', function () {
    return Inertia::render('AllTickets', [
        'userId' => Auth::id()
    ]);
})->middleware(['auth', 'verified'])->name('tickets');