<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::post('/auth', [UserController::class, 'login'])->name('user.login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'booking'], function () {
        Route::post('/', [BookingController::class, 'new'])->name('booking.new');
        Route::post('/{id}', [BookingController::class, 'update'])->name('booking.update');
        Route::get('/', [BookingController::class, 'getAll'])->name('booking.get-all');
        Route::get('/{id}', [BookingController::class, 'show'])->name('booking.show');
        Route::delete('/{id}', [BookingController::class, 'delete'])->name('booking.delete');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/bookings', [BookingController::class, 'getByUser'])->name('booking.get-by-user');
    });
});
