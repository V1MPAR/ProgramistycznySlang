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

Route::get('/', 'IndexController@index');

Route::get('/slang/voteup/{id}', 'SlangsController@voteUp')->middleware('auth');
Route::get('/slang/votedown/{id}', 'SlangsController@voteDown')->middleware('auth');
Route::get('/slang/random', 'SlangsController@random');
Route::get('/slang/acceptslangs', 'SlangsController@acceptSlangs')->middleware('auth');
Route::get('/slang/accept/{id}', 'SlangsController@accept')->middleware('auth');
Route::get('/slang/decline/{id}', 'SlangsController@decline')->middleware('auth');
Route::get('/slang/create', 'SlangsController@create')->middleware('auth');
Route::post('/slang/create', 'SlangsController@store')->middleware('auth');
Route::get('/slang/{slang}', 'SlangsController@slang');
Route::get('/letter/{letter}', 'SlangsController@letter');
Route::get('/tag/{tag}', 'SlangsController@tag');

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
