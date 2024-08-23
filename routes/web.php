<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::view('/', 'app.home');

    Route::view('/garage/{id}', 'app.garage.show');
    Route::view('/vehicle/{license_plate}', 'app.vehicle.show');

    Route::view('/new/garage', 'app.garage.create');
    Route::view('/new/vehicle', 'app.vehicle.create');

    Route::view('/edit/garage/{id}', 'app.garage.edit');
    Route::view('/edit/vehicle/{license_plate}', 'app.vehicle.edit');
});

Route::get('/login', [AuthController::class, 'showLoginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

