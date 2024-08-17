<?php

use App\Http\Controllers\API\EventPlanner\EventsController;
use App\Http\Controllers\API\User\{NotificationsController, ProfileController, SessionsController};
use App\Http\Controllers\API\Speakers\ProfileController as SpeakerProfileController;
use Illuminate\Support\Facades\Route;


//Profile Routes
Route::get('',[SpeakerProfileController::class,'index']);
Route::post('verify',[SpeakerProfileController::class,'verify']);
Route::post('complete-profile',[SpeakerProfileController::class,'completeProfile']);
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


//Get access ticket
Route::get('ticket',[EventsController::class,'getTicket']);
