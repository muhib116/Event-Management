<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




require_once('my-route/frontend.php');
require_once('my-route/event.php');
require_once('my-route/ticket.php');
require_once('my-route/advertise.php');
require_once('my-route/setting.php');

Route::group(['middleware' => ['auth', 'verified']],function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/event/manage/{url}', [EventController::class, 'manage'])->name('event.manage'); 
    Route::get('/live/account', [AccountController::class, 'index'])->name('live.account'); 
    // Route::post('store/event/{eventType}', [EventController::class, 'eventStore'])->name('event.store');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/event/manage/{url}', [EventController::class, 'manage'])->name('event.manage'); 


// Route::get('/live/account', function() {
//     return Inertia::render('Account', []);
// })->name('live.account');





Route::group(['as' => 'account.', 'prefix' => 'account', 'middleware' => 'auth'],function () {
    Route::post('/update-info', [AccountController::class, 'update_personal_info'])->name('update_info');
    Route::post('/update-password', [AccountController::class, 'update_password'])->name('update_password');
    Route::post('/update-interest', [AccountController::class, 'update_interest'])->name('update_interest');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::any('{url}', function(){
    return back();
})->where('url', '.*');