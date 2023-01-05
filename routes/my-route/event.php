<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('create/event/{eventType}', [EventController::class, 'index'])->name('event.create');
    Route::get('event/edit/{event_id}', [EventController::class, 'update'])->name('event.edit');

    Route::post('/event/{event}/create-discount', [EventController::class, 'create_discount'])->name('event.create_discount');


    Route::get('event/appearance/{event_id?}', function () {
        return Inertia::render('Appearance');
    })->name('appearance');

    Route::get('/organizer-payment', [TransactionController::class, 'index'])->name('organizer_payment');
    Route::post('create-transaction/{eventList}/{user}', [TransactionController::class, 'createTransaction'])->name('create_transaction');
});