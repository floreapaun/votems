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

Route::get('/generate', 'GenerateController@index')->name('generate');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/getvalue', 'AjaxController@index')->name('getvalue');
Route::post('/getcandid', 'AjaxController@getcandid')->name('getcandid');
Route::post('/getparty', 'AjaxController@getparty')->name('getparty');
Route::post('/makevote', 'MakeVoteController@store')->name('makevote');
Route::post('/get_image_data', 'AjaxController@get_image_data')->name('get_image_data');

