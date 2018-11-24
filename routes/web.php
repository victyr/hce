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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'statistics', 'as' => 'statistics.'], function(){
    Route::get('/', 'StatisticsController@index')->name('index');
    Route::post('/', 'StatisticsController@store')->name('store');
    Route::get('/create', 'StatisticsController@create')->name('create');
});
