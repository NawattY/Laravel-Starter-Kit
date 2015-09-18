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

    // Password reset link request routes...
    Route::get('password/forgot', array(
        'as' => 'password.forgot.get',
        'uses' => 'PasswordController@getEmail'
    ));
    Route::post('password/forgot', array(
        'as' => 'password.forgot.post',
        'uses' => 'PasswordController@postEmail'
    ));

    // Password reset routes...
    Route::get('password/reset/{token}', array(
        'as' => 'password.reset.get',
        'uses' => 'PasswordController@getReset'
    ));
    Route::post('password/reset', array(
        'as' => 'password.reset.post',
        'uses' => 'PasswordController@postReset'
    ));
});

Route::group(['as' => 'backend.', 'namespace' => 'Backend', 'prefix' => 'backend', 'middleware' => ['auth', 'acl']], function () {
    Route::get('/', [
        'as' => 'dashboard.index.get',
        'uses' => 'DashboardController@index'
    ]);

    /*
     * Error page
     */
    Route::group(['as' => 'error.', 'prefix' => 'error'], function () {
        Route::get('/{code}/{msg}', [
            'as' => 'index.get',
            'uses' => 'ErrorController@index'
        ]);
    });

    /*
     * User Management
     */
    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
        Route::get('/', [
            'as' => 'index.get',
            'uses' => 'UserController@index'
        ]);

        Route::get('/create', [
            'as' => 'create.get',
            'uses' => 'UserController@create'
        ]);

        Route::post('/', [
            'as' => 'store.post',
            'uses' => 'UserController@store'
        ]);

        Route::get('/{id}', [
            'as' => 'show.get',
            'uses' => 'UserController@show'
        ]);

        Route::get('/{id}/edit', [
            'as' => 'edit.get',
            'uses' => 'UserController@edit'
        ]);

        Route::match(['PUT', 'PATCH'], '/{id}', [
            'as' => 'update.put',
            'uses' => 'UserController@update'
        ]);

        Route::delete('/{id}', [
            'as' => 'destroy.delete',
            'uses' => 'UserController@destroy'
        ]);

        Route::get('/profile', [
            'as' => 'profile.get',
            'uses' => 'UserController@profile'
        ]);

        Route::match(['PUT', 'PATCH'], '/profile', [
            'as' => 'profile.put',
            'uses' => 'UserController@profileUpdate'
        ]);
    });

    /*
     * User Role Management
     */
    Route::group(['as' => 'role.', 'prefix' => 'role'], function () {
        Route::get('/', [
            'as' => 'index.get',
            'uses' => 'RoleController@index'
        ]);

        Route::get('/create', [
            'as' => 'create.get',
            'uses' => 'RoleController@create'
        ]);

        Route::post('/', [
            'as' => 'store.post',
            'uses' => 'RoleController@store'
        ]);

        Route::get('/{id}', [
            'as' => 'show.get',
            'uses' => 'RoleController@show'
        ]);

        Route::get('/{id}/edit', [
            'as' => 'edit.get',
            'uses' => 'RoleController@edit'
        ]);

        Route::match(['PUT', 'PATCH'], '/{id}', [
            'as' => 'update.put',
            'uses' => 'RoleController@update'
        ]);

        Route::delete('/{id}', [
            'as' => 'destroy.delete',
            'uses' => 'RoleController@destroy'
        ]);
    });

    /*
     * Role Permission Management
     */
    Route::group(['as' => 'permission.', 'prefix' => 'permission'], function () {
        Route::get('/', [
            'as' => 'index.get',
            'uses' => 'PermissionController@index'
        ]);

        Route::get('/create', [
            'as' => 'create.get',
            'uses' => 'PermissionController@create'
        ]);

        Route::post('/', [
            'as' => 'store.post',
            'uses' => 'PermissionController@store'
        ]);

        Route::get('/{id}', [
            'as' => 'show.get',
            'uses' => 'PermissionController@show'
        ]);

        Route::get('/{id}/edit', [
            'as' => 'edit.get',
            'uses' => 'PermissionController@edit'
        ]);

        Route::match(['PUT', 'PATCH'], '/{id}', [
            'as' => 'update.put',
            'uses' => 'PermissionController@update'
        ]);

        Route::delete('/{id}', [
            'as' => 'destroy.delete',
            'uses' => 'PermissionController@destroy'
        ]);
    });
});
