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
Route::get('/', function () {
    return redirect()->route('frontend.home');
});
  
Route::get('/index', function () {
    return redirect()->route('frontend.home');

});

Route::get('/home', function () {
    return redirect()->route('frontend.home');

});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('event:clear');
    return "All is cleared";
});


Route::get('/migrate', function () {
    //  Artisan::call('module:migrate CMS');
  //  Artisan::call('module:migrate Maknon');
    return "migrate done";

});
