<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StatisticsController;

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


Route::group(['prefix' => "auth"], function () {
    //auth
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => "auth"], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::group(['prefix' => "user"], function () {
        Route::apiResource('products', ProductController::class);
    });

    Route::group(['prefix' => "statistics"], function () {
        Route::get('task1', [StatisticsController::class, 'task1']);
        Route::get('task2', [StatisticsController::class, 'task2']);
        Route::get('part3', [StatisticsController::class, 'part3']);
    });

});
