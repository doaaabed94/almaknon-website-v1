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

Route::get('/', 'FrontendController@index')->name('frontend.home');

Route::group(['prefix' => 'cars', 'as' => 'CarController@'], function () {
    Route::get('/', 'CarController@index')->name('index');
    Route::get('/{slug}', 'CarController@single')->name('single');
    Route::get('/search', 'CarController@search')->name('search');
    Route::get('/{markas?}/{conditions?}/{fuel?}/{transmission?}', 'CarController@filter')->name('filter');
    Route::post('process_filter', 'CarController@prepareFilter')->name('prepareFilter');

});

Route::group(['prefix' => 'contact-us', 'as' => 'ContactController@'], function () {
    Route::get('/', 'ContactController@index')->name('index');
    Route::post('/store', 'ContactController@store')->name('store');
    Route::post('/store-visit', 'ContactController@storeVisit')->name('storeVisit');
    Route::post('/subscribe', 'ContactController@subscribe')->name('subscribe');
    Route::post('/store-inner', 'ContactController@storeInner')->name('storeInner');
});

Route::group(['prefix' => 'blogs', 'as' => 'BlogController@'], function () {
    Route::get('/', 'BlogController@index')->name('index');
    Route::get('/{slug}', 'BlogController@single')->name('single');

});
Route::get('/maknon/{slug}', 'BlogController@general')->name('BlogController@static');
Route::get('/aboutus', 'BlogController@general')->name('aboutus');

Route::group(['prefix' => 'users', 'as' => 'VisitorController@'], function () {
    Route::get('/login', 'VisitorController@login')->name('login');
    Route::get('/register', 'VisitorController@register')->name('register');
    Route::get('/favorite', 'VisitorController@favorite')->name('favorite');

    Route::post('/PostLogin', 'VisitorController@PostLogin')->name('PostLogin');
    Route::post('/PostRegister', 'VisitorController@PostRegister')->name('PostRegister');
    Route::post('/PostFavorite', 'VisitorController@PostFavorite')->name('PostFavorite');
});

Route::post('/newsletter/postCreate', 'FrontendController@newsletter')->name('newsletter@postCreate');
