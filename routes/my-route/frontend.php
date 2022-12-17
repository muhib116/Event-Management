<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

$data = [
    'canLogin' => Route::has('login') && !auth()->check(),
    'canRegister' => Route::has('register') && !auth()->check(),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
];


Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/event-details/{url}', [FrontendController::class, 'event_details'])->name('event.details');
Route::get('/checkout/{url}', [FrontendController::class, 'checkout'])->name('checkout');
Route::get('/payment-method/{url}', [FrontendController::class, 'payment'])->name('payment');
Route::post('/checkout/{EventList:slug}/process', [FrontendController::class, 'checkout_process'])->name('checkout.process');
Route::get('/category/{category}', [FrontendController::class, 'category_wise_event'])->name('category.event');





Route::get('/payment-complete', function () {
    return Inertia::render('Frontend/PaymentComplete', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('payment.complete');

Route::get('/search-result', function () use($data) {
    return Inertia::render('Frontend/SearchResult', $data);
})->name('search-result');



Route::get('/ticket-info/{url}', [FrontendController::class, 'ticket_info'])->name('ticket-info');