<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\GeneralApiController;
use App\Http\Controllers\Api\ProviderApiController;
use App\Http\Controllers\Api\YachtsApiController;
use App\Http\Controllers\Api\RatingsApiController;
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
//User Auth
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('/login', [AuthApiController::class, 'login']);
    Route::post('/register', [AuthApiController::class, 'register']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/profile', [AuthApiController::class, 'userProfile']);
    Route::get('/profile', [AuthApiController::class, 'userProfile']);
    Route::post('/updateProfile', [AuthApiController::class, 'updateProfile']);
    Route::post('/checkPhone', [AuthApiController::class, 'checkPhone']);
    Route::post('/updatePassword', [AuthApiController::class, 'updatePassword']);
    Route::post('/checkVerification', [AuthApiController::class, 'checkVerification']);
});
//Return All Countries
Route::get('/countries', [GeneralApiController::class, 'countries']);

//Return All Cities
Route::get('/cities', [GeneralApiController::class, 'cities']);

//Return All Static Pages
Route::get('/pages', [GeneralApiController::class, 'pages']);

//Return Adv Banners
Route::get('/banners', [GeneralApiController::class, 'banners']);

//Return Faqs
Route::get('/faqs', [GeneralApiController::class, 'faqs']);

//Contact Us
Route::post('/contactUs', [GeneralApiController::class, 'contactUs']);

//Return Settings
Route::get('/settings', [GeneralApiController::class, 'settings']);

//Return providers
Route::get('/providers', [ProviderApiController::class, 'list']);

//Return yachts
Route::get('/yachts', [YachtsApiController::class, 'list']);

//Rating
Route::get('/rate/list', [RatingsApiController::class, 'list']);

//User Route
Route::group(['middleware' => 'CheckUserAuth','prefix' => 'user'], function () {
    //Rating
    Route::post('/rate/store', [RatingsApiController::class, 'store']);
});

//Provider Route
Route::group(['middleware' => 'CheckProviderAuth','prefix' => 'provider'], function () {
    //Rating
    Route::post('/rate/store', [RatingsApiController::class, 'store']);
});
