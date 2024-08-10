<?php

use App\Http\Controllers\API\Auth\{LoginController , RegisterController , RequestToJoinController};
use Illuminate\Support\Facades\Route;


Route::post('login',LoginController::class);
Route::post('register',RegisterController::class);
Route::post('request-to-join',RequestToJoinController::class);
