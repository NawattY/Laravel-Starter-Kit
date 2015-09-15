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

Route::get('/', function () {
    return view('welcome');
});

/*
 * Backend
 */
Route::group(['as' => 'auth.', 'prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('/login', [
        'as' => 'login.get',
        'uses' => 'AuthController@getLogin'
    ]);

    Route::post('/login', [
        'as' => 'login.post',
        'uses' => 'AuthController@postLogin'
    ]);

    Route::get('logout', array(
        'as' => 'logout.get',
        'uses' => 'AuthController@getLogout'
    ));

    Route::get('register', array(
        'as' => 'register.get',
        'uses' => 'AuthController@getRegister'
    ));

    Route::post('register', array(
        'as' => 'register.post',
        'uses' => 'AuthController@postRegister'
    ));
});

Route::group(['as' => 'backend.', 'namespace' => 'Backend', 'prefix' => 'backend', 'middleware' => 'auth'], function () {
    Route::get('/', [
        'as' => 'dashboard.get',
        'uses' => 'DashboardController@index'
    ]);
});
