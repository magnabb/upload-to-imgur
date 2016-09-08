<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ImagesController@index');
Route::get('upload/{id}', 'ImagesController@upload');
Route::get('add', 'ImagesController@addForm');
Route::post('add', 'ImagesController@add');