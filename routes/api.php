<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1',"namespace"=>"Api"], function () {
    Route::post('/register',"ClientController@register");
    Route::post('/login',"ClientController@login");
    Route::post('/resetPassword',"ClientController@resetPassword");
    Route::post('/changPassword',"ClientController@changPassword");



    Route::group(['middleware' => 'auth:api'], function () {

        Route::post('/registerToken',"ClientController@registerToken");
        Route::post('/removeToken',"ClientController@removeToken");

        Route::post('/profile',"ClientController@profile");
        Route::post('/notificationSetting',"ClientController@notificationSetting");
        Route::post('/post',"PostController@post");
        Route::post('/favorite',"PostController@favorite");
        Route::get('/myFavorite',"PostController@myFavorite");

        Route::get('/getDonation',"DonationController@getDonation");
        Route::post('/addDonation',"DonationController@addDonation");
        Route::get('/getAllDonations',"DonationController@getAllDonations");

    });

     /////////////////////general //////////////////////////////
     Route::post('/cities',"GeneralController@cities");
     Route::post('/govern',"GeneralController@govern");
     Route::get('/governs',"GeneralController@governs");
     Route::get('/bloodTypes',"GeneralController@bloodTypes");
     Route::get('/setting',"GeneralController@setting");
     Route::post('/contact',"GeneralController@contact");
     //////////////////////post/////////////////////



     Route::get('/categories',"PostController@categories");
     Route::post('/posts',"PostController@posts");







    });
