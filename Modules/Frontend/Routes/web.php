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
//   Route::get('/clear-cache', 'HomeController@clearCache')->name('cache.clear');

  Route::get('/', 'FrontendController@index')->name('frontend.home');

    Route::get('/config/clear', function (){
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        dd('done');
    });


    Route::group(['prefix' => 'cars', 'as' => 'CarController@'], function () {
        Route::get('/',        'CarController@index')->name('index');
        Route::get('/{slug}',        'CarController@single')->name('single');
        Route::get('/search',               'CarController@search')->name('search');
       	Route::get('/{opportunity_classification}/{contract}/{city}/{area?}', 'CarController@filter')->name('filter');
        Route::post('process_filter',       'CarController@prepareFilter')->name('prepareFilter');

    });
    

    Route::group(['prefix' => 'contact-us', 'as' => 'ContactController@'], function () {
        Route::get('/'              , 'ContactController@index')->name('index');
        Route::post('/store'        , 'ContactController@store')->name('store');
        Route::post('/store-visit'  , 'ContactController@storeVisit')->name('storeVisit');
        Route::post('/subscribe'    , 'ContactController@subscribe')->name('subscribe');
        Route::post('/store-inner'  , 'ContactController@storeInner')->name('storeInner');
    });


  Route::group(['prefix' => 'blogs', 'as' => 'BlogController@'], function () {
        Route::get('/',        'BlogController@index')->name('index');
        Route::get('/{type}/{slug}',        'BlogController@single')->name('single');
    });

