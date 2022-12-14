<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileUploadController;

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


Route::post('store/event/{eventType}', [EventController::class, 'eventStore'])->name('event.store');
Route::post('store/file-upload/{id?}', [FileUploadController::class, 'fileUpload'])->name('file.store');
Route::get('files/{id}', [FileUploadController::class, 'files'])->name('files');
Route::get('file-delete/{id}', [FileUploadController::class, 'fileDelete'])->name('file.delete');