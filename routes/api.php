<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 
// Authentication Routes

Route::post('/', [\Modules\BackOffice\Http\Controllers\UserTmControllers::class, 'store']);
Route::get('/', [\Modules\BackOffice\Http\Controllers\UserTypeController::class, 'index']);
Route::post('/login', [\Modules\BackOffice\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\Modules\BackOffice\Http\Controllers\AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    // User Type Routes
    Route::prefix('user-types')->group(function () {
        Route::post('/', [\Modules\BackOffice\Http\Controllers\UserTypeController::class, 'store']);
        Route::get('/{id}', [\Modules\BackOffice\Http\Controllers\UserTypeController::class, 'show']);
        Route::put('/{id}', [\Modules\BackOffice\Http\Controllers\UserTypeController::class, 'update']);
        Route::delete('/{id}', [\Modules\BackOffice\Http\Controllers\UserTypeController::class, 'destroy']);
    });

    // User TM Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [\Modules\BackOffice\Http\Controllers\UserTmControllers::class, 'index']);
        Route::get('/{id}', [\Modules\BackOffice\Http\Controllers\UserTmControllers::class, 'show']);
        Route::put('/{id}', [\Modules\BackOffice\Http\Controllers\UserTmControllers::class, 'update']);
        Route::delete('/{id}', [\Modules\BackOffice\Http\Controllers\UserTmControllers::class, 'destroy']);
    });
});

