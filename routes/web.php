<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require_once('my-route/frontend.php');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/event/manage/{name}', [EventController::class, 'manage'])->name('event.manage');
Route::post('/event/{event}/create-discount', [EventController::class, 'create_discount'])->name('event.create_discount');


Route::get('/live/account', function() {
    return Inertia::render('Account', []);
})->name('live.account');

Route::get('create/event/{eventType}', [EventController::class, 'index'])->name('event.create');
Route::post('store/event/{eventType}', [EventController::class, 'eventStore'])->name('event.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
