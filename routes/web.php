<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Api\SocialController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/lang-change', [HomeController::class ,'changLang'])->name('admin.lang.change');

Route::get('/','HomeController@index')->name('index');
Route::get('/policy','HomeController@policy')->name('policy');

Route::get('/google', [SocialController::class,'redirectToGoogle']);
Route::get('/google/callback', [SocialController::class,'handleGoogleCallback']);

Route::get('/twitter', [SocialController::class,'redirectToTwitter']);
Route::get('/twitter/callback', [SocialController::class,'handleTwitterCallback']);
