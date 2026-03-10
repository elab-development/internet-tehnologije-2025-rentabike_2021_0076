<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReservationController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/equipment', [EquipmentController::class, 'index']);
Route::get('/equipment/{id}', [EquipmentController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/reservations', [ReservationController::class, 'index']);

    Route::middleware('role:customer')->group(function () {

        Route::post('/reservations', [ReservationController::class, 'store']);

        // BRISANJE REZERVACIJE
        Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

    });

    Route::middleware('role:admin,employee')->group(function () {

        Route::post('/equipment', [EquipmentController::class, 'store']);
        Route::put('/equipment/{id}', [EquipmentController::class, 'update']);
        Route::delete('/equipment/{id}', [EquipmentController::class, 'destroy']);

    });

});