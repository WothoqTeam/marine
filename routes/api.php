<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\GeneralApiController;

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
    Route::post('/checkVerification', [AuthApiController::class, 'checkVerification']);
    Route::post('/checkPhone', [AuthApiController::class, 'checkPhone']);
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

//Return Faqs
Route::get('/settings', [GeneralApiController::class, 'settings']);
