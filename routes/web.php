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

Route::get('/', 'Web\AppController@index')->middleware('auth');

//Auth::routes();

//
//Route::get('/login', 'Web\AppController@getLogin' )
//    ->name('login')
//    ->middleware('guest');
Route::get('/login','Web\AuthticationController@getLogin')->name('login');;
Route::post('/login','Web\AuthticationController@login');
Route::get('/logout','Web\AuthticationController@logout');