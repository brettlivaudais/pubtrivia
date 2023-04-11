<?php

use App\Http\Controllers\GeoLocationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserFavoriteController;
use App\Http\Controllers\UserLocationRatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


Route::get('/geolocation/{lat}/{long}', [GeoLocationController::class, 'getLocationByLatLong']);
Route::get('/autocomplete/{search}', [GeoLocationController::class, 'autocompleteSearch']);
Route::get('/search', [LocationController::class, 'apiSearch']);
Route::get('/search', [LocationController::class, 'apiSearch']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('favorite/add/{location_id}', [UserFavoriteController::class, 'add']);
    Route::get('favorite/remove/{location_id}', [UserFavoriteController::class, 'remove']);
    Route::get('rating/add/{location_id}/{rating}', [UserLocationRatingController::class, 'addOrUpdateRating']);
    Route::post('/messages/{recipient_id}', [MessageController::class, 'store']);
});
