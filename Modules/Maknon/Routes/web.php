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

Route::prefix('dashboard')->group(function() {

Route::prefix('cars')->group(function() {
    Route::get('/'                     , 'CarController@index')->name('cars.index');
    Route::post('/'                    , 'CarController@postIndex')->name('cars.postIndex');
    Route::get('list'                  , 'CarController@ajaxList')->name('cars.ajaxList');
    Route::get('create'                , 'CarController@create')->name('cars.create');
    Route::post('create'               , 'CarController@postCreate')->name('cars.postCreate');
    Route::get('{model}/update'        , 'CarController@update')->name('cars.update');
    Route::post('{model}/update'       , 'CarController@postUpdate')->name('cars.postUpdate');
    Route::post('{model}/delete'       , 'CarController@postDelete')->name('cars.postDelete');
    Route::post('{model}/restore'      , 'CarController@postRestore')->name('cars.postRestore');
    Route::post('{model}/perma-delete' , 'CarController@postPermaDelete')->name('cars.postPermaDelete');
    Route::post('{model}/toggle-status', 'CarController@postStatus')->name('cars.postStatus');
    Route::get('{model}'               , 'CarController@read')->name('cars.read');
});

Route::prefix('markas')->group(function() {
    Route::get('/'                     , 'MarkaController@index')->name('markas.index');
    Route::post('/'                    , 'MarkaController@postIndex')->name('markas.postIndex');
    Route::get('list'                  , 'MarkaController@ajaxList')->name('markas.ajaxList');
    Route::get('create'                , 'MarkaController@create')->name('markas.create');
    Route::post('create'               , 'MarkaController@postCreate')->name('markas.postCreate');
    Route::get('{model}/update'        , 'MarkaController@update')->name('markas.update');
    Route::post('{model}/update'       , 'MarkaController@postUpdate')->name('markas.postUpdate');
    Route::post('{model}/delete'       , 'MarkaController@postDelete')->name('markas.postDelete');
    Route::post('{model}/restore'      , 'MarkaController@postRestore')->name('markas.postRestore');
    Route::post('{model}/perma-delete' , 'MarkaController@postPermaDelete')->name('markas.postPermaDelete');
    Route::post('{model}/toggle-status', 'MarkaController@postStatus')->name('markas.postStatus');
    Route::get('{model}'               , 'MarkaController@read')->name('markas.read');
});

Route::prefix('fuels')->group(function() {
    Route::get('/'                     , 'FuelController@index')->name('fuels.index');
    Route::post('/'                    , 'FuelController@postIndex')->name('fuels.postIndex');
    Route::get('list'                  , 'FuelController@ajaxList')->name('fuels.ajaxList');
    Route::get('create'                , 'FuelController@create')->name('fuels.create');
    Route::post('create'               , 'FuelController@postCreate')->name('fuels.postCreate');
    Route::get('{model}/update'        , 'FuelController@update')->name('fuels.update');
    Route::post('{model}/update'       , 'FuelController@postUpdate')->name('fuels.postUpdate');
    Route::post('{model}/delete'       , 'FuelController@postDelete')->name('fuels.postDelete');
    Route::post('{model}/restore'      , 'FuelController@postRestore')->name('fuels.postRestore');
    Route::post('{model}/perma-delete' , 'FuelController@postPermaDelete')->name('fuels.postPermaDelete');
    Route::post('{model}/toggle-status', 'FuelController@postStatus')->name('fuels.postStatus');
    Route::get('{model}'               , 'FuelController@read')->name('fuels.read');
});

Route::prefix('conditions')->group(function() {
    Route::get('/'                     , 'ConditionController@index')->name('conditions.index');
    Route::post('/'                    , 'ConditionController@postIndex')->name('conditions.postIndex');
    Route::get('list'                  , 'ConditionController@ajaxList')->name('conditions.ajaxList');
    Route::get('create'                , 'ConditionController@create')->name('conditions.create');
    Route::post('create'               , 'ConditionController@postCreate')->name('conditions.postCreate');
    Route::get('{model}/update'        , 'ConditionController@update')->name('conditions.update');
    Route::post('{model}/update'       , 'ConditionController@postUpdate')->name('conditions.postUpdate');
    Route::post('{model}/delete'       , 'ConditionController@postDelete')->name('conditions.postDelete');
    Route::post('{model}/restore'      , 'ConditionController@postRestore')->name('conditions.postRestore');
    Route::post('{model}/perma-delete' , 'ConditionController@postPermaDelete')->name('conditions.postPermaDelete');
    Route::post('{model}/toggle-status', 'ConditionController@postStatus')->name('conditions.postStatus');
    Route::get('{model}'               , 'ConditionController@read')->name('conditions.read');
});

Route::prefix('offers')->group(function() {
    Route::get('/'                     , 'OfferController@index')->name('offers.index');
    Route::post('/'                    , 'OfferController@postIndex')->name('offers.postIndex');
    Route::get('list'                  , 'OfferController@ajaxList')->name('offers.ajaxList');
    Route::get('create'                , 'OfferController@create')->name('offers.create');
    Route::post('create'               , 'OfferController@postCreate')->name('offers.postCreate');
    Route::get('{model}/update'        , 'OfferController@update')->name('offers.update');
    Route::post('{model}/update'       , 'OfferController@postUpdate')->name('offers.postUpdate');
    Route::post('{model}/delete'       , 'OfferController@postDelete')->name('offers.postDelete');
    Route::post('{model}/restore'      , 'OfferController@postRestore')->name('offers.postRestore');
    Route::post('{model}/perma-delete' , 'OfferController@postPermaDelete')->name('offers.postPermaDelete');
    Route::post('{model}/toggle-status', 'OfferController@postStatus')->name('offers.postStatus');
    Route::get('{model}'               , 'OfferController@read')->name('offers.read');
});


});