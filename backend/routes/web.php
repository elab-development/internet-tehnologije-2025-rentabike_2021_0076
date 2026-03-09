<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bikes', [BikeController::class, 'index']);
Route::post('/bikes', [BikeController::class, 'store']);
Route::get('/bikes/{id}', [BikeController::class, 'show']);
Route::put('/bikes/{id}', [BikeController::class, 'update']);
Route::delete('/bikes/{id}', [BikeController::class, 'destroy']);
Route::get('/reservations', [ReservationController::class, 'index']);
Route::post('/reservations', [ReservationController::class, 'store']);