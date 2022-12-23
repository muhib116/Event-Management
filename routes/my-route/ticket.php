<?php

use App\Http\Controllers\EventTicketController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
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

Route::get('event/ticket-design/{eventTickets}', [EventTicketController::class, 'ticket_design'])
    ->middleware(['auth', 'verified'])
    ->name('ticket_design');
Route::get('event/ticket-view/{ticketSales}', [EventTicketController::class, 'ticket_view'])
    ->middleware(['auth', 'verified'])
    ->name('ticket_view');