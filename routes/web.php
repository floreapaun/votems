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
Route::post('/get_avg_age', 'AjaxController@get_avg_age')->name('get_avg_age');
Route::post('/get_cnt_poor', 'AjaxController@get_cnt_poor')->name('get_cnt_poor');
Route::post('/getcandid', 'AjaxController@getcandid')->name('getcandid');
Route::post('/getparty', 'AjaxController@getparty')->name('getparty');
Route::post('/makevote', 'MakeVoteController@store')->name('makevote');
Route::post('/get_image_data_TopReg', 'AjaxController@get_image_data_TopReg')->name('get_image_data_TopReg');
Route::post('/get_image_data_TopYng', 'AjaxController@get_image_data_TopYng')->name('get_image_data_TopYng');
Route::post('/get_image_data_TopHgh', 'AjaxController@get_image_data_TopHgh')->name('get_image_data_TopHgh');

