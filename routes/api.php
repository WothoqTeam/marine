<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\GeneralApiController;
use App\Http\Controllers\Api\ProviderApiController;
use App\Http\Controllers\Api\YachtsApiController;
use App\Http\Controllers\Api\RatingsApiController;
use App\Http\Controllers\Api\FavouritesApiController;
use App\Http\Controllers\Api\ReservationsApiController;
use App\Http\Controllers\Api\NotificationsApiController;
use App\Http\Controllers\Api\ChatsApiController;
use App\Http\Controllers\Api\SpecificationsApiController;
use App\Http\Controllers\Api\MarasiApiController;
use App\Http\Controllers\Api\MarasiReservationsApiController;
use App\Http\Controllers\Api\GasStationsApiController;
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
    Route::post('/updateLanguage', [AuthApiController::class, 'updateLanguage']);
    Route::post('/updateUserImage', [AuthApiController::class, 'updateUserImage']);
    Route::post('/updateStatus', [AuthApiController::class, 'updateStatus']);
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

    //Favourites
    Route::get('/favourites', [FavouritesApiController::class, 'index']);
    Route::post('/favourites/store', [FavouritesApiController::class, 'store']);

    //Notifications
    Route::get('/notifications', [NotificationsApiController::class, 'index']);

    //Chats
    Route::get('/chat', [ChatsApiController::class, 'index']);
    Route::post('/chat/store', [ChatsApiController::class, 'store']);
    Route::get('/chat/threads/{id}', [ChatsApiController::class, 'threads']);

    //Reservations
    Route::get('/reservations/list', [ReservationsApiController::class, 'userList']);
    Route::get('/reservations/{id}', [ReservationsApiController::class, 'details']);
    Route::post('/reservations/store', [ReservationsApiController::class, 'store']);
    Route::post('/reservations/update/{id}', [ReservationsApiController::class, 'update']);
    Route::post('/reservations/cancel/{id}', [ReservationsApiController::class, 'cancel']);
    Route::post('/reservations/pay/{id}', [ReservationsApiController::class, 'pay']);
});
Route::get('user/reservation/status', [ReservationsApiController::class, 'UrwayPaymentStatus']);

//Provider Route
Route::group(['middleware' => 'CheckProviderAuth','prefix' => 'provider'], function () {
    //Dashboard
    Route::get('/dashboard', [ProviderApiController::class, 'statistics']);

    //Rating
    Route::post('/rate/store', [RatingsApiController::class, 'store']);

    //Notifications
    Route::get('/notifications', [NotificationsApiController::class, 'index']);

    //Chats
    Route::get('/chat', [ChatsApiController::class, 'index']);
    Route::post('/chat/store', [ChatsApiController::class, 'store']);
    Route::get('/chat/threads/{id}', [ChatsApiController::class, 'threads']);

    //Reservations
    Route::get('/reservations/list', [ReservationsApiController::class, 'providerList']);
    Route::get('/reservations/{id}', [ReservationsApiController::class, 'details']);
    Route::post('/reservations/requests', [ReservationsApiController::class, 'providerRequests']);

    //Specifications
    Route::get('/specifications', [SpecificationsApiController::class, 'list']);

    //yachts
    Route::get('/yachts', [YachtsApiController::class, 'providerYachts']);
    Route::get('/yachts/{id}', [YachtsApiController::class, 'details']);
    Route::post('/yachts/store', [YachtsApiController::class, 'store']);
    Route::post('/yachts/update/{id}', [YachtsApiController::class, 'update']);
    Route::post('/yachts/updateStatus/{id}', [YachtsApiController::class, 'updateStatus']);

    //Return Marasi
    Route::get('/marasi', [MarasiApiController::class, 'list']);

    //Marasi Reservations
    Route::get('/marasi/reservations/list', [MarasiReservationsApiController::class, 'List']);
    Route::post('/marasi/reservations/store', [MarasiReservationsApiController::class, 'store']);
    Route::post('/marasi/reservations/update/{id}', [MarasiReservationsApiController::class, 'update']);
    Route::post('/marasi/reservations/cancel/{id}', [MarasiReservationsApiController::class, 'cancel']);
    Route::post('/marasi/reservations/pay/{id}', [MarasiReservationsApiController::class, 'pay']);
    Route::get('marasi/reservations/{id}', [MarasiReservationsApiController::class, 'details']);

    //Return Marasi
    Route::get('/gasStations', [GasStationsApiController::class, 'list']);
});
Route::get('/provider/marasi/reservation/status', [MarasiReservationsApiController::class, 'UrwayPaymentStatus']);
