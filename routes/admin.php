<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\HomeController;

Auth::routes();

Route::get('/lang-change', [HomeController::class, 'changLang'])->name('admin.lang.change');
Route::get('/login', [AdminLoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/login', [AdminLoginController::class, 'adminLogin'])->name('admin.login.submit');
Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::name('admin.')->middleware(['auth:admin'])->group(function () {

    Route::middleware(['emp-access:dash'])->group(function () {

        Route::get('/', 'HomeController@index')->name('index');

        Route::name('settings.')->prefix('settings')->group(function () {
            Route::get('/edit/{id}', 'SettingsController@edit')->name('edit');
            Route::post('/update', 'SettingsController@update')->name('update');
        });

        Route::name('employees.')->prefix('employees')->group(function () {
            Route::get('/', 'EmployeesController@index')->name('index');
            Route::get('/show/{id}', 'EmployeesController@show')->name('show');
            Route::post('/delete', 'EmployeesController@destroy')->name('delete');
            Route::get('/create', 'EmployeesController@create')->name('create');
            Route::post('/store', 'EmployeesController@store')->name('store');
            Route::get('/edit/{id}', 'EmployeesController@edit')->name('edit');
            Route::post('/update', 'EmployeesController@update')->name('update');
            Route::PATCH('/updateFcm', 'EmployeesController@updateFcm')->name('updateFcm');
        });

        Route::name('users.')->prefix('users')->group(function () {
            Route::get('/', 'UsersController@index')->name('index');
            Route::get('/show/{id}', 'UsersController@show')->name('show');
            Route::post('/delete', 'UsersController@destroy')->name('delete');
            Route::get('/create', 'UsersController@create')->name('create');
            Route::post('/store', 'UsersController@store')->name('store');
            Route::get('/edit/{id}', 'UsersController@edit')->name('edit');
            Route::post('/update', 'UsersController@update')->name('update');
        });

        Route::name('providers.')->prefix('providers')->group(function () {
            Route::get('/', 'ProvidersController@index')->name('index');
            Route::get('/show/{id}', 'ProvidersController@show')->name('show');
            Route::post('/delete', 'ProvidersController@destroy')->name('delete');
            Route::get('/create', 'ProvidersController@create')->name('create');
            Route::post('/store', 'ProvidersController@store')->name('store');
            Route::get('/edit/{id}', 'ProvidersController@edit')->name('edit');
            Route::post('/update', 'ProvidersController@update')->name('update');
        });

        Route::name('countries.')->prefix('countries')->group(function () {
            Route::get('/', 'CountriesController@index')->name('index');
            Route::post('/delete', 'CountriesController@destroy')->name('delete');
            Route::get('/create', 'CountriesController@create')->name('create');
            Route::post('/store', 'CountriesController@store')->name('store');
            Route::get('/edit/{id}', 'CountriesController@edit')->name('edit');
            Route::post('/update', 'CountriesController@update')->name('update');
        });

        Route::name('cities.')->prefix('cities')->group(function () {
            Route::get('/', 'CitiesController@index')->name('index');
            Route::post('/delete', 'CitiesController@destroy')->name('delete');
            Route::get('/create', 'CitiesController@create')->name('create');
            Route::post('/store', 'CitiesController@store')->name('store');
            Route::get('/edit/{id}', 'CitiesController@edit')->name('edit');
            Route::post('/update', 'CitiesController@update')->name('update');
        });

        Route::name('faqs.')->prefix('faqs')->group(function () {
            Route::get('/', 'FaqsController@index')->name('index');
            Route::get('/show/{id}', 'FaqsController@show')->name('show');
            Route::post('/delete', 'FaqsController@destroy')->name('delete');
            Route::get('/create', 'FaqsController@create')->name('create');
            Route::post('/store', 'FaqsController@store')->name('store');
            Route::get('/edit/{id}', 'FaqsController@edit')->name('edit');
            Route::post('/update', 'FaqsController@update')->name('update');
        });

        Route::name('pages.')->prefix('pages')->group(function () {
            Route::get('/', 'PagesController@index')->name('index');
            Route::get('/show/{id}', 'PagesController@show')->name('show');
//        Route::post('/delete', 'PagesController@destroy')->name('delete');
//        Route::get('/create','PagesController@create')->name('create');
//        Route::post('/store','PagesController@store')->name('store');
            Route::get('/edit/{id}', 'PagesController@edit')->name('edit');
            Route::post('/update', 'PagesController@update')->name('update');
        });

        Route::name('banners.')->prefix('banners')->group(function () {
            Route::get('/', 'BannersController@index')->name('index');
            Route::get('/show/{id}', 'BannersController@show')->name('show');
            Route::post('/delete', 'BannersController@destroy')->name('delete');
            Route::get('/create', 'BannersController@create')->name('create');
            Route::post('/store', 'BannersController@store')->name('store');
            Route::get('/edit/{id}', 'BannersController@edit')->name('edit');
            Route::post('/update', 'BannersController@update')->name('update');
        });

        Route::name('contactUs.')->prefix('contactUs')->group(function () {
            Route::get('/', 'ContactUsController@index')->name('index');
            Route::post('/delete', 'ContactUsController@destroy')->name('delete');
            Route::get('/show/{id}', 'ContactUsController@show')->name('show');
        });

        Route::name('notifications.')->prefix('notifications')->group(function () {
            Route::get('/', 'NotificationsController@index')->name('index');
            Route::get('/create', 'NotificationsController@create')->name('create');
            Route::post('/store', 'NotificationsController@store')->name('store');
        });

        Route::name('yachts.')->prefix('yachts')->group(function () {
            Route::get('/', 'YachtsController@index')->name('index');
            Route::get('/show/{id}', 'YachtsController@show')->name('show');
            Route::post('/updateStatus', 'YachtsController@updateStatus')->name('updateStatus');
        });

        Route::name('marasi.')->prefix('marasi')->group(function () {
            Route::get('/', 'MarasiController@index')->name('index');
            Route::get('/show/{id}', 'MarasiController@show')->name('show');
            Route::post('/delete', 'MarasiController@destroy')->name('delete');
            Route::get('/create', 'MarasiController@create')->name('create');
            Route::post('/store', 'MarasiController@store')->name('store');
            Route::get('/edit/{id}', 'MarasiController@edit')->name('edit');
            Route::post('/update', 'MarasiController@update')->name('update');
            Route::post('/updateStatus', 'MarasiController@updateStatus')->name('updateStatus');
        });

        Route::name('marasi_owner.')->prefix('marasi_owner')->group(function () {
            Route::get('/', 'MarasiOwnerController@index')->name('index');
            Route::get('/show/{id}', 'MarasiOwnerController@show')->name('show');
            Route::post('/delete', 'MarasiOwnerController@destroy')->name('delete');
            Route::get('/create', 'MarasiOwnerController@create')->name('create');
            Route::post('/store', 'MarasiOwnerController@store')->name('store');
            Route::get('/edit/{id}', 'MarasiOwnerController@edit')->name('edit');
            Route::post('/update', 'MarasiOwnerController@update')->name('update');
        });
    });

});
