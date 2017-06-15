<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$demo = false;

if (isset($demo) && $demo == true) {
    Route::get('/', function ()
    {
        return view('comingsoon');
    });
} else {
    Route::controller('/api', 'ApiController');

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | This route group applies the "web" middleware group to every route
    | it contains. The "web" middleware group is defined in your HTTP
    | kernel and includes session state, CSRF protection, and more.
    |
    */

    Route::group(['middleware' => ['web']], function () {
        //
    });

    Route::group(['middleware' => 'web'], function () {
        Route::auth();

        Route::controller('/admin', 'AdminController');
        Route::controller('/password', 'Auth\PasswordController');
        Route::controller('/', 'HomeController');
    });
}


