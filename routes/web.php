<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\JoinRequestController;
use App\Jobs\RequestToJoinJob;
use App\Models\EventPlannerRequest;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPdf\Facades\Pdf;

Route::view('/', 'welcome')->name('home');
Route::view('login', 'auth.login')->name('login');
Route::post('login', LoginController::class);
Route::get('join-request',[JoinRequestController::class, 'index'])->name('join-request');
Route::post('join-request',[JoinRequestController::class, 'store'])->name('join-request.store');
Route::get('check-join-request',[JoinRequestController::class, 'check'])->name('check-join-request');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return view('verified');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('test-pdf',function(){
    $user = User::find(26);
    return view('pdf.speaker_id', compact('user'));
});
