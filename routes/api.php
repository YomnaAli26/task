<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\Auth\{LoginController, RegisterController, VerifyController};
use Illuminate\Support\Facades\Route;


//Authentication routes
Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);
Route::post('/verify', VerifyController::class)->name('verify');
/*============================================================================*/

Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');
Route::get('stats', StatsController::class);
