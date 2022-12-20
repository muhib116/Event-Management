<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\EventTicketController;
use App\Http\Controllers\TicketSaleController;
use App\Http\Controllers\GuestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// event api
Route::post('store/event', [EventController::class, 'eventStore'])->name('event.store');
Route::post('event/edit/{eventId}', [EventController::class, 'eventEdit'])->name('event.edit');
Route::post('event/publish/{eventId}', [EventController::class, 'editPublish'])->name('event.publish');
Route::get('event/{eventList}', [EventController::class, 'getEvent'])->name('event.get');

// fileUpload api
Route::post('store/file-upload/{id?}', [FileUploadController::class, 'fileUpload'])->name('file.store');
Route::get('files/{id}', [FileUploadController::class, 'files'])->name('files');
Route::get('file-delete/{id}', [FileUploadController::class, 'fileDelete'])->name('file.delete');


// ticket api
Route::post('create/ticket/{event_id}', [EventTicketController::class, 'store'])->name('ticket.create');
Route::post('update/ticket/{id}', [EventTicketController::class, 'update'])->name('ticket.update');
Route::get('get/tickets/{event_id}', [EventTicketController::class, 'getTicket'])->name('ticket.create');
Route::get('duplicate/ticket/{id}', [EventTicketController::class, 'duplicate'])->name('ticket.duplicate');
Route::get('delete/ticket/{id}', [EventTicketController::class, 'deleteTicket'])->name('ticket.delete');
Route::post('ticket/sale', [TicketSaleController::class, 'sale'])->name('ticket.sale');




// guest api
Route::get('guest/{email}', [GuestController::class, 'getGuest'])->name('get.guest');
Route::post('guest-create', [GuestController::class, 'createGuest'])->name('create.guest');
