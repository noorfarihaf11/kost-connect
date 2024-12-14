<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Room;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/payment', function () {
    return view('dashboard.payment');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/daftarkost', [HomeController::class, 'rooms']);
Route::get('/daftarkost/{id}', function ($id) {
    $room = Room::findOrFail($id);
    return response()->json($room);
});


Route::get('/cities', [CityController::class, 'index'])->middleware('owner');
Route::post('/cities', [CityController::class, 'store']);
Route::put('/cities/{id}', [CityController::class, 'update']);
Route::delete('/cities/{id}', [CityController::class, 'destroy']);

Route::get('/roles', [RoleController::class, 'index']);;
Route::post('/roles', [RoleController::class, 'store']);
Route::put('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

Route::get('/register', [AuthController::class, 'index'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/users', [UserController::class, 'index']);

Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/submitRoomForm', [RoomController::class, 'store']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);

Route::post('/submitreservation', [ReservationController::class, 'submitreservation']);
Route::get('/reservation', [ReservationController::class, 'index'])->middleware('auth');
Route::post('/reservation', [ReservationController::class, 'store']);
Route::put('/reservation/{id}', [ReservationController::class, 'update']);

Route::get('/payment', [PaymentController::class, 'index'])->middleware('auth');
Route::put('/payment/{id}/upload-proof', [PaymentController::class, 'uploadPaymentProof'])->middleware('auth');
Route::put('/payment/{id}/confirm', [PaymentController::class, 'confirmPayment'])->middleware('auth');

Route::get('/customer', [CustomerController::class, 'index'])->middleware('auth');

Route::get('/masuk', [AuthController::class, 'showLoginOptions'])->name('masuk')->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/masuk', [AuthController::class, 'showLoginOptions'])->name('login.options');

Route::get('/register', [AuthController::class, 'index'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/register/pemilik', [AuthController::class, 'showRegisterPemilik'])->name('register.pemilik');
Route::post('/register/pemilik', [AuthController::class, 'registerPemilik']);

Route::get('/owners', [OwnerController::class, 'index']);

Route::get('/rumahkost', [BoardingHouseController::class, 'index']);
Route::post('/submitHouseForm', [BoardingHouseController::class, 'store']);

Route::post('/snap-token', [PaymentController::class, 'getSnapToken']);

Route::get('/dashboard', [DashboardController::class, 'index']);