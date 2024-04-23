<?php

use App\Http\Controllers\AuthController;
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

use App\Http\Controllers\UserController;

Route::prefix('auth')->middleware('api')->namespace('App\Http\Controllers')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);

    Route::patch('users/{id}', [UserController::class, 'update']);
    Route::put('users/{id}', [UserController::class, 'update']);

    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('users', [UserController::class, 'store']);
        Route::delete('users/{id}', [UserController::class, 'destroy']);
    });

    Route::group(['middleware' => ['role:user']], function () {
        
    });
});