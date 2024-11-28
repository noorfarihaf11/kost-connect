<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Models\Room;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware('auth');

Route::get('/home', function () {
    return view('home.dashboard');
});

Route::get('/payment', function () {
    return view('dashboard.payment');
});

Route::get('/daftarkost', [HomeController::class, 'rooms']);
Route::get('/daftarkost/{id}', function ($id) {
    $room = Room::findOrFail($id);
    return response()->json($room);
});


Route::get('/cities', [CityController::class, 'index'])->middleware('admin');
Route::post('/cities', [CityController::class, 'store']);
Route::put('/cities/{id}', [CityController::class, 'update']);
Route::delete('/cities/{id}', [CityController::class, 'destroy']);

Route::get('/roles', [RoleController::class, 'index'])->middleware('admin');;
Route::post('/roles', [RoleController::class, 'store']);
Route::put('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

Route::get('/register', [AuthController::class, 'index'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/users', [UserController::class, 'index'])->middleware('admin');

Route::get('/rooms', [RoomController::class, 'index'])->middleware('admin');
Route::post('/rooms', [RoomController::class, 'store']);

Route::post('/submitreservation', [ReservationController::class, 'submitreservation']);
Route::get('/reservation', [ReservationController::class, 'index'])->middleware('auth');
Route::post('/reservation', [ReservationController::class, 'store']);
Route::put('/reservation/{id}', [ReservationController::class, 'update']);

Route::get('/payment', [PaymentController::class, 'index'])->middleware('auth');
Route::put('/payment/{id}', [PaymentController::class, 'update']);
