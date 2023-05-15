<?php

use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\SupermarketController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {
    Route::prefix('supermarkets')->group(function () {
        Route::get('/', [SupermarketController::class, 'index'])->name('supermarkets.get');
        Route::post('/', [SupermarketController::class, 'store'])->name('supermarket.store');
        Route::get('/{id}', [SupermarketController::class, 'show'])->name('supermarket');
        Route::post('update/{id}', [SupermarketController::class, 'update'])->name('supermarket.update');

    });

    Route::prefix('locations')->group(function () {
        Route::get('/', [LocationController::class, 'index']);

    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);

    });


});
