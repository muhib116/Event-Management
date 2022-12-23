<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('settings/', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings/save', [SettingController::class, 'save'])->name('settings.save');
});