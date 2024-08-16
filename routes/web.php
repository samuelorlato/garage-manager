<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [GarageController::class, 'index']);

    Route::get('/garage/{id}', [GarageController::class, 'show']);
    Route::get('/vehicle/{license_plate}', [VehicleController::class, 'show']);

    Route::get('/new/garage', [GarageController::class, 'create']);
    Route::post('/new/garage', [GarageController::class, 'store']);
    Route::get('/new/vehicle/{garage_id}', [VehicleController::class, 'create']);
    Route::post('/new/vehicle/{garage_id}', [VehicleController::class, 'store']);

    Route::get('/update/garage/{id}/{name}', [GarageController::class, 'edit']);
    Route::patch('/update/garage/{id}', [GarageController::class, 'update']);
    Route::get('/update/garage/{garage_id}/vehicle/{license_plate}', [VehicleController::class, 'edit']);
    Route::patch('/update/garage/{garage_id}/vehicle/{license_plate}', [VehicleController::class, 'update']);

    Route::delete('/delete/garage/{id}', [GarageController::class, 'destroy']);
    Route::delete('/delete/garage/{garage_id}/vehicle/{license_plate}', [VehicleController::class, 'destroy']);
});

Route::get('/login', [AuthController::class, 'showLoginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

