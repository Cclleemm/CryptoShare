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

/* Routes for authentification */
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//Routes when logged in
Route::group(['middleware' => 'auth'], function()
{
	/* Routes for Resources */
	Route::get('recipient', 'RecipientController@index');
	Route::resource('configuration', 'ConfigurationController');

});

Route::get('update', 'UpdateController@index');
Route::post('update', 'UpdateController@index');
