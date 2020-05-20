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
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

    Route::middleware(['auth'])->group(function () {

        Route::resource('/governs', 'governController');
        Route::resource('/cities', 'cityController');
        Route::resource('/categories', 'categoryController');
        Route::resource('/posts', 'postController');

    });
});
