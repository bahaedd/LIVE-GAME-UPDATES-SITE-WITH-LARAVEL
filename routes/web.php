<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/games/{id}', 'HomeController@viewGame');
Route::post('/games', 'HomeController@startGame')->middleware('auth');
Route::post('/games/{id}', 'HomeController@updateGame')->middleware('auth');
Route::post('/games/{id}/score', 'HomeController@updateScore')->middleware('auth');
