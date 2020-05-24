<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|//
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::group(['prefix' => LaravelLocalization::setLocale()], function()
//{

    Route::middleware(['auth',"auto-check-permission"])->group(function () {
        Route::get('/', function () {
            return view('dashboard.welcome');
        })->name("home");
        Route::resource('/governs', 'governController');
        Route::resource('/cities', 'cityController');
        Route::resource('/categories', 'categoryController');
        Route::resource('/posts', 'postController');
        Route::resource('/bloodTypes', 'bloodTypeController');
        Route::resource('/contacts', 'contactController');
        Route::resource('/donationReqs', 'donationReqController');
        Route::resource('/roles', 'roleController');
        Route::resource('/users', 'userController');
        Route::get('/clients', 'clientController@index')->name('clients.index');
        Route::get('/clients/active/{id}', 'clientController@active')->name('clients.active');
        Route::get('/clients/Inactive/{id}', 'clientController@Inactive')->name('clients.Inactive');
        Route::delete('/clients/delete/{id}', 'clientController@delete')->name('clients.delete');
        Route::get('/settings', 'settingController@index')->name('settings.index');
        Route::post('/settings/update', 'settingController@update')->name('settings.update');
        Route::get('/profile', 'profileController@index')->name('profile.index');

        Route::post('/profile/email', 'profileController@email')->name('profile.email');
        Route::post('/profile/password', 'profileController@password')->name('profile.password');
        Route::post('/profile/username', 'profileController@username')->name('profile.username');

    });
//});
