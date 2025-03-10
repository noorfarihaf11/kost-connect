<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StatusReservasiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/midtrans/transaction', [PaymentController::class, 'initiatePayment']);
Route::post('/midtrans/notification',  [PaymentController::class, 'handleNotification']);
Route::get('/status-reservasi', [StatusReservasiController::class, 'index'])->name('status-reservasi.index');
