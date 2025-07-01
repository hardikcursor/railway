<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingOfficeAnswerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Auth Routes
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'getuser']);

// Booking Office Answer Routes
Route::prefix('booking-office-answers')->group(function () {
    Route::post('/bookinganswer', [BookingOfficeAnswerController::class, 'store']);
    Route::get('/', [BookingOfficeAnswerController::class, 'index']);
    // Route::get('/{id}', [BookingOfficeAnswerController::class, 'show']);
    Route::get('/quotations', [BookingOfficeAnswerController::class, 'bookingquotionshow']);
});


