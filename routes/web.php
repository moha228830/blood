<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{





Route::middleware(['auth:clients'])->group(function () {
    Route::post('/toggle_favourite', 'HomeController@toggle_favourite')->name('toggle-favourite');

});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('/home/donation', 'HomeController@donation')->name('front.donation');
Route::get('/home/donation/details/{id}', 'HomeController@donation_details')->name('front.donation.details');
Route::get('/client_posts', 'HomeController@posts')->name('client_posts');
Route::get('/client_post/{id}', 'HomeController@post')->name('client_post');
Route::get('/sine_up', 'Auth\clientsLoginController@sine_up')->name('sine_up');
Route::post('/sine_up/save', 'Auth\clientsLoginController@sine_up_submit')->name('sine_up_submit');
Route::get('/client/login', 'Auth\clientsLoginController@showLoginForm')->name('client_login');
Route::post('/client/login', 'Auth\clientsLoginController@login')->name('client_login_submit');
Route::get('/client/logout', 'Auth\clientsLoginController@logout')->name('client_logout');



});
