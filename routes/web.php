<?php

use App\Http\Controllers\Web\JoinRequestController;
use App\Jobs\RequestToJoinJob;
use App\Models\EventPlannerRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPdf\Facades\Pdf;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('join-request',[JoinRequestController::class, 'index'])->name('join-request');
Route::post('join-request',[JoinRequestController::class, 'store'])->name('join-request.store');
Route::get('check-join-request',[JoinRequestController::class, 'check'])->name('check-join-request');

Route::get('test-mail', function () {
    $reservation = Reservation::find('5');
    return view('emails.reservation', compact('reservation'));
});
