<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');


Route::auth();


Route::group(['prefix' => 'lb-admin','middleware' => ['auth']], function () {


    Route::get('/', 'Admin\AdminHomeController@index');
    Route::resource('post','PostController');
    Route::resource('category','Admin\CategoryController');
    Route::resource('tag','Admin\TagController');

});

Route::get('{year}/{month}/{slug}', 'PostController@show')->where('year', '[0-9]+')->where('month', '[0-9]+');