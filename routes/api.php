<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingOfficeAnswerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('/booking-office-details', [BookingOfficeAnswerController::class, 'BookingOfficeDetail']);
    Route::post('/bookinganswer', [BookingOfficeAnswerController::class, 'store']);
    Route::get('/', [BookingOfficeAnswerController::class, 'bookinganswershow']);
    // Route::get('/{id}', [BookingOfficeAnswerController::class, 'show']);
    Route::get('/quotations', [BookingOfficeAnswerController::class, 'bookingquotionshow']);
    Route::post('/prs-office-details', [BookingOfficeAnswerController::class, 'PrsOfficeDetail']);
    Route::get('/prs-quotations', [BookingOfficeAnswerController::class, 'prsgquotionshow']);
    Route::post('/prsanswer', [BookingOfficeAnswerController::class, 'prsanswer']);
    Route::post('/parcel-office-details', [BookingOfficeAnswerController::class, 'ParcelOfficeDetail']);
    Route::get('/parcel-quotations', [BookingOfficeAnswerController::class, 'parcelgquotionshow']);
    Route::post('/parcelanswer', [BookingOfficeAnswerController::class, 'ParcelOfficeAnswer']);
    Route::post('/goodshed-office-details', [BookingOfficeAnswerController::class, 'goodshedofficeDetail']);
    Route::get('/goodshed-quotations', [BookingOfficeAnswerController::class, 'goodshedoffice']);
    Route::post('/goods-shed-office-answer', [BookingOfficeAnswerController::class, 'goodsShedOfficeAnswer']);
    Route::post('/ticketexaminer-office-details', [BookingOfficeAnswerController::class, 'ticketexaminerDetail']);
    Route::get('/ticketexaminer-quotations', [BookingOfficeAnswerController::class, 'ticketexaminerquotionshow']);
    Route::post('/ticketexaminer-answer', [BookingOfficeAnswerController::class, 'ticketexaminerquotionAnswer']);
    Route::get('/nonfare-quotations', [BookingOfficeAnswerController::class, 'nonfarequotionshow']);
    Route::post('/nonfare-answer', [BookingOfficeAnswerController::class, 'nonfarequotionanswer']);
    Route::get('/inspection-quotations', [BookingOfficeAnswerController::class, 'inspectionOfPassengerAmenitiesItems']);
    Route::post('/inspection-answer', [BookingOfficeAnswerController::class, 'inspectionOfPassengerAnswer']);
    Route::get('/station-cleanliness', [BookingOfficeAnswerController::class, 'stationCleanlinessProforma']);
    Route::post('/station-cleanliness-answer', [BookingOfficeAnswerController::class, 'stationCleanlinessAnswer']);
    Route::post('/inspection-pay-use-toilets-details', [BookingOfficeAnswerController::class, 'storeToiletLocation']);
    Route::get('/inspection-pay-use-toilets', [BookingOfficeAnswerController::class, 'inspectionOfPayAndUseToilets']);
    Route::post('/inspection-pay-use-toilets-answer', [BookingOfficeAnswerController::class, 'inspectionOfPayAndUseToiletsAnswer']);
    Route::get('/inspection-tea-and-light-refreshment-stall', [BookingOfficeAnswerController::class, 'inspectionOfTeaAndLightRefreshmentStall']);
    Route::post('/inspection-tea-answer', [BookingOfficeAnswerController::class, 'inspectionTeaAnswer']);
    Route::post('/inspection-pantry-car-details', [BookingOfficeAnswerController::class, 'inspectionOfPantryCarDetail']);
    Route::get('/inspection-pantry-car', [BookingOfficeAnswerController::class, 'inspectionOfPantryCar']);
    Route::post('/inspection-pantry-car-answer', [BookingOfficeAnswerController::class, 'inspectionOfPantryCarAnswer']);
    Route::get('/inspection-base-kitchen', [BookingOfficeAnswerController::class, 'inspectionOfBaseKitchen']);
    Route::post('/inspection-base-kitchen-answer', [BookingOfficeAnswerController::class, 'inspectionBaseKitchenAnswer']);
    Route::post('/inspectionstore', [BookingOfficeAnswerController::class, 'inspectionstore']);

});


// https://themewagon.github.io/Presento/
// https://themewagon.github.io/bizcraft/blog-item.html