<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SanctumController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;
use App\Models\Event;
use App\Models\Reservation;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('sanctum/token', [SanctumController::class, 'auth'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('event')->group(function () {
        Route::get('{offset?}/{limit?}', [EventController::class, 'index']);
        Route::post('', [EventController::class, 'store']);
        Route::put('{' . Event::ROUTE_BINDING_ENTITY_NAME . '}', [EventController::class, 'update']);
        Route::delete('{' . Event::ROUTE_BINDING_ENTITY_NAME . '}', [EventController::class, 'destroy']);
    });

    Route::prefix('reservation')->group(function () {
        Route::get('{offset?}/{limit?}', [ReservationController::class, 'index']);
        Route::post('', [ReservationController::class, 'store']);
        Route::delete('{' . Reservation::ROUTE_BINDING_ENTITY_NAME . '}', [ReservationController::class, 'destroy']);
    });
});
