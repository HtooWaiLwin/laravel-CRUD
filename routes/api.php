<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GuestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:6,1');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:6,1');

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::post('/guests', [GuestController::class, 'store']);

        Route::match(['put', 'patch'], '/guests/{guest}', [
            GuestController::class,
            'update',
        ]);

        Route::delete('/guests/{guest}', [
            GuestController::class,
            'destroy',
        ]);

        Route::get('/guests/deleted', [GuestController::class, 'deleted']);

        Route::patch('/guests/{id}/restore', [GuestController::class, 'restore']);

        Route::delete('/guests/{id}/force-delete', [GuestController::class, 'forceDelete']);
    });

    Route::get('/guests', [GuestController::class, 'index']);

    Route::get('/guests/{guest}', [GuestController::class, 'show']);
});
