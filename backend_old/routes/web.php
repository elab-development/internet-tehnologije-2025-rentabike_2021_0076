<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Equipments', [EquipmentController::class, 'index']);
Route::post('/Equipments', [EquipmentController::class, 'store']);
Route::get('/Equipments/{id}', [EquipmentController::class, 'show']);
Route::put('/Equipments/{id}', [EquipmentController::class, 'update']);
Route::delete('/Equipments/{id}', [EquipmentController::class, 'destroy']);
Route::get('/reservations', [ReservationController::class, 'index']);
Route::post('/reservations', [ReservationController::class, 'store']);