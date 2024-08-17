<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\{JoinRequestController , ResetPasswordController};
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::get('join-request',[JoinRequestController::class, 'index'])->name('join-request');
Route::post('join-request',[JoinRequestController::class, 'store'])->name('join-request.store');
Route::get('check-join-request',[JoinRequestController::class, 'check'])->name('check-join-request');

Route::view('login', 'auth.login')->name('login');
Route::post('login', LoginController::class);
Route::get('/email/verify/{id}/{hash}', ResetPasswordController::class)->middleware(['auth', 'signed'])->name('verification.verify');

