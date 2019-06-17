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
Route::get('/update', 'UpdateController@index')->name('update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/get_avg_age', 'AjaxController@get_avg_age')->name('get_avg_age');
Route::post('/update_gdp', 'AjaxController@update_gdp')->name('update_gdp');
Route::post('/write_voting_state', 'AjaxController@write_voting_state')->name('write_voting_state');
Route::post('/update_corr', 'AjaxController@update_corr')->name('update_corr');
Route::post('/get_win_corrupt', 'AjaxController@get_win_corrupt')->name('get_win_corrupt');
Route::post('/get_cnt_poor', 'AjaxController@get_cnt_poor')->name('get_cnt_poor');
Route::post('/getcandid', 'AjaxController@getcandid')->name('getcandid');
Route::post('/getparty', 'AjaxController@getparty')->name('getparty');
Route::post('/makevote', 'MakeVoteController@store')->name('makevote');
Route::post('/get_image_data_TopReg', 'AjaxController@get_image_data_TopReg')->name('get_image_data_TopReg');
Route::post('/get_image_data_TopYng', 'AjaxController@get_image_data_TopYng')->name('get_image_data_TopYng');
Route::post('/get_image_data_TopHgh', 'AjaxController@get_image_data_TopHgh')->name('get_image_data_TopHgh');

