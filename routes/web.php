<?php

use App\Http\Controllers\Web\JoinRequestController;
use App\Jobs\RequestToJoinJob;
use App\Models\EventPlannerRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('join-request',[JoinRequestController::class, 'index'])->name('join-request');
Route::post('join-request',[JoinRequestController::class, 'store'])->name('join-request.store');
Route::get('check-join-request',[JoinRequestController::class, 'check'])->name('check-join-request');


