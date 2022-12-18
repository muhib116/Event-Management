<?php

use App\Http\Controllers\AvaertiseController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('event/advertise/', [AvaertiseController::class, 'index'])->name('advertise.index');
    Route::post('event/advertise/store', [AvaertiseController::class, 'store'])->name('advertise.store');
    Route::delete('event/advertise/delete', [AvaertiseController::class, 'delete'])->name('advertise.delete');
});