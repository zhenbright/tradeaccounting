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
// use Auth;
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function ()  {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('/dbf/getRecords', 'DBFController@getRecords');
    Route::get('/dbf/getProducts', 'DBFController@getProductList');
    Route::get('/dbf/{view}', "DBFController@view");
    Route::get('/dashboard', function (){
        return view('layouts.contentNavbarLayout');
    });
    
});

Auth::routes();

