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

Route::get('update', 'UpdateController@index');
Route::post('update', 'UpdateController@index');

//Routes when logged in
Route::group(['middleware' => 'auth'], function()
{
	/* Routes for Resources */
	Route::resource('recipient', 'RecipientController');
    Route::resource('transaction', 'TransactionController');
	Route::resource('configuration', 'ConfigurationController');

});