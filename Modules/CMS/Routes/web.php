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


Route::prefix('dashboard')->name('cms::')->group(function () {

    Route::prefix('contents')->group(function() {
        Route::get('/'                     , 'ContentController@index')->name('contents.index');
        Route::post('/'                    , 'ContentController@postIndex')->name('contents.postIndex');
        Route::get('list'                  , 'ContentController@ajaxList')->name('contents.ajaxList');
        Route::get('create'                , 'ContentController@create')->name('contents.create');
        Route::post('create'               , 'ContentController@postCreate')->name('contents.postCreate');
        Route::get('{model}/update'        , 'ContentController@update')->name('contents.update');
        Route::post('{model}/update'       , 'ContentController@postUpdate')->name('contents.postUpdate');
        Route::post('{model}/delete'       , 'ContentController@postDelete')->name('contents.postDelete');
        Route::post('{model}/restore'      , 'ContentController@postRestore')->name('contents.postRestore');
        Route::post('{model}/perma-delete' , 'ContentController@postPermaDelete')->name('contents.postPermaDelete');
        Route::post('{model}/toggle-status', 'ContentController@postStatus')->name('contents.postStatus');
        Route::get('{model}'               , 'ContentController@read')->name('contents.read');
    });

    Route::prefix('categories')->group(function() {
        Route::get('/'                     , 'CategoryController@index')->name('categories.index');
        Route::post('/'                    , 'CategoryController@postIndex')->name('categories.postIndex');
        Route::get('list'                  , 'CategoryController@ajaxList')->name('categories.ajaxList');
        Route::get('create'                , 'CategoryController@create')->name('categories.create');
        Route::post('create'               , 'CategoryController@postCreate')->name('categories.postCreate');
        Route::get('{model}/update'        , 'CategoryController@update')->name('categories.update');
        Route::post('{model}/update'       , 'CategoryController@postUpdate')->name('categories.postUpdate');
        Route::post('{model}/delete'       , 'CategoryController@postDelete')->name('categories.postDelete');
        Route::post('{model}/restore'      , 'CategoryController@postRestore')->name('categories.postRestore');
        Route::post('{model}/perma-delete' , 'CategoryController@postPermaDelete')->name('categories.postPermaDelete');
        Route::post('{model}/toggle-status', 'CategoryController@postStatus')->name('categories.postStatus');
        Route::get('{model}'               , 'CategoryController@read')->name('categories.read');
    });


    Route::prefix('sub_categories')->group(function() {
        Route::get('/'                     , 'SubCategoryController@index')->name('sub_categories.index');
        Route::post('/'                    , 'SubCategoryController@postIndex')->name('sub_categories.postIndex');
        Route::get('list'                  , 'SubCategoryController@ajaxList')->name('sub_categories.ajaxList');
        Route::get('create'                , 'SubCategoryController@create')->name('sub_categories.create');
        Route::post('create'               , 'SubCategoryController@postCreate')->name('sub_categories.postCreate');
        Route::get('{model}/update'        , 'SubCategoryController@update')->name('sub_categories.update');
        Route::post('{model}/update'       , 'SubCategoryController@postUpdate')->name('sub_categories.postUpdate');
        Route::post('{model}/delete'       , 'SubCategoryController@postDelete')->name('sub_categories.postDelete');
        Route::post('{model}/restore'      , 'SubCategoryController@postRestore')->name('sub_categories.postRestore');
        Route::post('{model}/perma-delete' , 'SubCategoryController@postPermaDelete')->name('sub_categories.postPermaDelete');
        Route::post('{model}/toggle-status', 'SubCategoryController@postStatus')->name('sub_categories.postStatus');
        Route::get('{model}'               , 'SubCategoryController@read')->name('sub_categories.read');
    });

});

