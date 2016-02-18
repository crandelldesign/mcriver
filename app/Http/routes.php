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
/*Route::get('/admin', function () {
    return view('admin.index');
});*/

//Route::controller('/', 'HomeController');

Route::controller('/api', 'ApiController');
Route::get('/', 'HomeController@getIndex');
Route::get('/not-permitted', 'HomeController@getNotPermitted');
Route::get('/sign-up', 'HomeController@getSignUp');
Route::get('/sign-up/2', 'HomeController@getSignUpStep2'); //Add in Order Number

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
});
