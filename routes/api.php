<?php

use App\Http\Controllers\Api\Auth\{LoginController, RegisterController, VerifyController};
use Illuminate\Support\Facades\Route;


                //Authentication routes
Route::post('/register',RegisterController::class);
Route::post('/login',LoginController::class);
Route::post('/verify',VerifyController::class)->name('verify');
/*============================================================================*/
