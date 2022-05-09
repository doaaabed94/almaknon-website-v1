<?php

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

Route::get('/home', 'AdminController@index')->name('index');

Route::prefix('dashboard')->name('member::')->group(function () {

    Route::get('/', 'AdminController@index')->name('index');
    Route::get('Member/{module}', 'AdminController@index')->name('customIndex');

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('users.index');
        Route::post('/', 'UserController@postIndex')->name('users.postIndex');
        Route::get('create', 'UserController@create')->name('users.create');
        Route::post('create', 'UserController@postCreate')->name('users.postCreate');
        Route::get('{model}/update', 'UserController@update')->name('users.update');
        Route::post('{model}/update', 'UserController@postUpdate')->name('users.postUpdate');
        Route::post('{model}/delete', 'UserController@postDelete')->name('users.postDelete');
        Route::post('{model}/restore', 'UserController@postRestore')->name('users.postRestore');
        Route::post('{model}/perma-delete', 'UserController@postPermaDelete')->name('users.postPermaDelete');
        Route::post('{model}/toggle-status', 'UserController@postStatus')->name('users.postStatus');
        Route::post('login-as/{model}', 'UserController@loginAs')->name('users.loginAs');
        Route::post('login-as-token', 'UserController@loginAsFromToken')->name('users.loginAsFromToken');
        Route::get('{model}', 'UserController@read')->name('users.read');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', 'RoleController@index')->name('roles.index');
        Route::post('/', 'RoleController@postIndex')->name('roles.postIndex');
        Route::get('create', 'RoleController@create')->name('roles.create');
        Route::post('create', 'RoleController@postCreate')->name('roles.postCreate');
        Route::get('{model}/update', 'RoleController@update')->name('roles.update');
        Route::post('{model}/update', 'RoleController@postUpdate')->name('roles.postUpdate');
        Route::post('{model}/delete', 'RoleController@postDelete')->name('roles.postDelete');
        Route::post('{model}/restore', 'RoleController@postRestore')->name('roles.postRestore');
        Route::post('{model}/perma-delete', 'RoleController@postPermaDelete')->name('roles.postPermaDelete');
        Route::post('{model}/toggle-status', 'RoleController@postStatus')->name('roles.postStatus');
        Route::get('{model}', 'RoleController@read')->name('roles.read');
    });

    Route::prefix('config')->group(function () {
        Route::get('update', 'ConfigController@update')->name('ConfigController@update');
        Route::post('update', 'ConfigController@postUpdate')->name('ConfigController@postUpdate');
        Route::get('{tab?}', 'ConfigController@read')->name('ConfigController@read');
    });

    Route::prefix('profile')->group(function () {
        Route::get('update', 'ProfileController@update')->name('ProfileController@update');
        Route::post('update', 'ProfileController@postUpdate')->name('ProfileController@postUpdate');
    });

    Route::prefix('countries')->group(function() {
        Route::get('/'                     , 'CountryController@index')->name('countries.index');
        Route::post('/'                    , 'CountryController@postIndex')->name('countries.postIndex');
        Route::get('list'                  , 'CountryController@ajaxList')->name('countries.ajaxList');
        Route::get('create'                , 'CountryController@create')->name('countries.create');
        Route::post('create'               , 'CountryController@postCreate')->name('countries.postCreate');
        Route::get('{model}/update'        , 'CountryController@update')->name('countries.update');
        Route::post('{model}/update'       , 'CountryController@postUpdate')->name('countries.postUpdate');
        Route::post('{model}/delete'       , 'CountryController@postDelete')->name('countries.postDelete');
        Route::post('{model}/restore'      , 'CountryController@postRestore')->name('countries.postRestore');
        Route::post('{model}/perma-delete' , 'CountryController@postPermaDelete')->name('countries.postPermaDelete');
        Route::post('{model}/toggle-status', 'CountryController@postStatus')->name('countries.postStatus');
        Route::get('{model}'               , 'CountryController@read')->name('countries.read');
    });

    Route::prefix('cities')->group(function() {
        Route::get('/'                     , 'CityController@index')->name('CityController@index');
        Route::post('/'                    , 'CityController@postIndex')->name('CityController@postIndex');
        Route::get('list'                  , 'CityController@ajaxList')->name('CityController@ajaxList');
        Route::get('create'                , 'CityController@create')->name('CityController@create');
        Route::post('create'               , 'CityController@postCreate')->name('CityController@postCreate');
        Route::get('{model}/update'        , 'CityController@update')->name('CityController@update');
        Route::post('{model}/update'       , 'CityController@postUpdate')->name('CityController@postUpdate');
        Route::post('{model}/delete'       , 'CityController@postDelete')->name('CityController@postDelete');
        Route::post('{model}/restore'      , 'CityController@postRestore')->name('CityController@postRestore');
        Route::post('{model}/perma-delete' , 'CityController@postPermaDelete')->name('CityController@postPermaDelete');
        Route::post('{model}/toggle-status', 'CityController@postStatus')->name('CityController@postStatus');
        Route::get('{model}'               , 'CityController@read')->name('CityController@read');
    });
});



Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@postLogin')->name('postLogin');
Route::get('login-by-token', 'AuthController@getLoginByJwtToken')->name('getLoginByJwtToken');
Route::get('register', 'AuthController@register')->name('register');
Route::post('register', 'AuthController@postRegister')->name('postRegister');
Route::get('request-verify', 'AuthController@verifyRequest')->name('verifyRequest');
Route::post('request-verify', 'AuthController@postVerifyRequest')->name('postVerifyRequest');
Route::get('request-reset', 'AuthController@resetRequest')->name('resetRequest');
Route::post('request-reset', 'AuthController@postResetRequest')->name('postResetRequest');
Route::get('change-password/{token}', 'AuthController@changePassword')->name('changePassword');
Route::post('change-password', 'AuthController@postChangePassword')->name('postChangePassword');
Route::get('logout', 'AuthController@postLogout')->name('postLogout');
Route::post('logout', 'AuthController@postLogout')->name('postLogout');