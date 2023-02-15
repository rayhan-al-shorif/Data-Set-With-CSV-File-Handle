<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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

// For Using sanctum Token Authentication
Route::middleware('guest:sanctum')
    ->group(function () {
        Route::post('/user-login', [AuthController::class, 'userLogin'])->name('user-login');
    });
Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/user-data/{id?}', [UserController::class, 'userData'])->name('userData');
    });
