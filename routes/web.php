<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('guests.index');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::get('/guests', [GuestController::class, 'index'])
        ->middleware('role:admin,viewer')
        ->name('guests.index');

    Route::get('/guests/{guest}/posts', [PostController::class, 'index'])
        ->middleware('role:admin,viewer')
        ->name('guests.posts.index');

    Route::middleware('role:admin')->group(function () {

        Route::get('/guests/create', [GuestController::class, 'create'])
            ->name('guests.create');

        Route::post('/guests', [GuestController::class, 'store'])
            ->name('guests.store');

        Route::get('/guests/{guest}/edit', [GuestController::class, 'edit'])
            ->name('guests.edit');

        Route::put('/guests/{guest}', [GuestController::class, 'update'])
            ->name('guests.update');

        Route::delete('/guests/{guest}', [GuestController::class, 'destroy'])
            ->name('guests.destroy');

        Route::get('/guests/deleted', [GuestController::class, 'deleted'])
            ->name('guests.deleted');

        Route::patch('/guests/{id}/restore', [GuestController::class, 'restore'])
            ->name('guests.restore');

        Route::delete('/guests/{id}/force-delete', [GuestController::class, 'forceDelete'])
            ->name('guests.forceDelete');

        Route::get('/guests/{guest}/posts/form', [PostController::class, 'create'])
            ->name('guests.posts.create');

        Route::post('/guests/{guest}/posts', [PostController::class, 'store'])
            ->name('guests.posts.store');

        Route::delete('/guests/{guest}/posts/{post}', [PostController::class, 'destroy'])
            ->name('guests.posts.destroy');

        Route::get('/guests/{guest}/posts/{post}/edit', [PostController::class, 'edit'])
            ->name('guests.posts.edit');

        Route::put('/guests/{guest}/posts/{post}', [PostController::class, 'update'])
            ->name('guests.posts.update');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
