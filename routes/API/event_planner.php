<?php

use App\Http\Controllers\API\EventPlanner\EventsController;
use App\Http\Controllers\API\EventPlanner\SpeakersController;
use App\Http\Controllers\API\User\{NotificationsController, ProfileController, SessionsController};
use Illuminate\Support\Facades\Route;


//Profile Routes
Route::get('',[ProfileController::class,'index']);
Route::post('',[ProfileController::class,'update']);
Route::post('password',[ProfileController::class,'updatePassword']);

//Sessions Routes
Route::get('sessions',[SessionsController::class,'index']);
Route::delete('sessions/{type}',[SessionsController::class,'destroy']);


//Notifications Routes
Route::get('notifications',[NotificationsController::class,'index']);
Route::get('notifications/{notification}',[NotificationsController::class,'read'])->whereUuid('notification')->name('notification.read');

//Events Routes
Route::get('events',[EventsController::class,'index']);
Route::get('event/{event:uuid}',[EventsController::class,'show'])->whereUuid('uuid')->name('event.show');
Route::post('events',[EventsController::class,'store']);
Route::post('events/{event:uuid}/price',[EventsController::class,'storePrice']);

//Speakers Routes
Route::get('speakers',[SpeakersController::class,'index']);
Route::post('speakers',[SpeakersController::class,'store']);
Route::get('speakers/{speaker:uuid}',[SpeakersController::class,'show'])->whereUuid('uuid')->name('speaker.show');
Route::post('speakers/{speaker:uuid}',[SpeakersController::class,'destroy'])->whereUuid('uuid')->name('speaker.destroy');
