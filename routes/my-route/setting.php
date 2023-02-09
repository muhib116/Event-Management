<?php

use App\Http\Controllers\PaymentDetailsController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('settings/', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings/save', [SettingController::class, 'save'])->name('settings.save'); 
});

Route::group(['middleware' => ['auth', 'verified']], function() { 
    // payment details
    Route::post('/payment-details/save', [PaymentDetailsController::class, 'save'])
        ->name('payment_details.save');
    Route::get('/payment-details/get', [PaymentDetailsController::class, 'get'])
        ->name('payment_details.get');
    Route::delete('/payment-details/{infoId}', [PaymentDetailsController::class, 'delete_info'])
        ->name('account.delete_info');
});
