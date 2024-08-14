<?php

use App\Http\Controllers\API\User\EventsController;
use App\Http\Controllers\API\User\NotificationsController;
use App\Http\Controllers\API\User\ProfileController;
use App\Http\Controllers\API\User\ReservationsController;
use App\Http\Controllers\API\User\SessionsController;
use Illuminate\Support\Facades\Route;


//Profile Routes
Route::get('',[ProfileController::class,'index']);
Route::post('',[ProfileController::class,'update']);
Route::post('password',[ProfileController::class,'updatePassword']);
Route::post('avatar',[ProfileController::class,'updateAvatar']);

//Sessions Routes
Route::get('sessions',[SessionsController::class,'index']);
Route::delete('sessions/{type}',[SessionsController::class,'destroy']);


//Events Routes
Route::get('events',[EventsController::class,'index']);
Route::get('event/{event:uuid}',[EventsController::class,'show'])->whereUuid('uuid')->name('event.show');

//Reservations Routes
Route::get('reservations',[ReservationsController::class,'index']);
Route::post('reservations',[ReservationsController::class,'store']);
Route::get('reservation/{reservation:uuid}',[ReservationsController::class,'show'])->whereUuid('uuid')->name('reservation.show');

//Notifications Routes
Route::get('notifications',[NotificationsController::class,'index']);
Route::get('notifications/{notification}',[NotificationsController::class,'read'])->whereUuid('notification')->name('notification.read');
