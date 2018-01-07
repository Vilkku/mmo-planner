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

Route::get('login', 'AuthController@login')->name('login');
Route::get('return-bnet', 'AuthController@return');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/raids/{raid}', 'RaidController@show')->name('raid');
Route::post('/raids/{raid}', 'RaidController@signUp')->name('raidSignUp');
Route::get('/raids', 'RaidController@index')->name('raids');
