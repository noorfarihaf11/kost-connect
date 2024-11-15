<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.dashboard')->middleware('auth');
});

Route::get('/home', function () {
    return view('home.dashboard');
});
Route::get('/kost', function () {
    return view('home.kost');
});


Route::get('/cities', [CityController::class, 'index']);
Route::post('/cities', [CityController::class, 'store']);
Route::put('/cities/{id}', [CityController::class, 'update']);
Route::delete('/cities/{id}', [CityController::class, 'destroy']);

Route::get('/roles', [RoleController::class, 'index']);
Route::post('/roles', [RoleController::class, 'store']);
Route::put('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

Route::get('/register', [AuthController::class, 'index'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/users', [UserController::class, 'index']);

Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms', [RoomController::class, 'store']);