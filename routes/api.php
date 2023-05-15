<?php

use App\Http\Controllers\Api\SupermarketController;
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
        Route::get('/', [SupermarketController::class, 'index']);
        Route::get('/{id}', [SupermarketController::class, 'show']);

    });

});
