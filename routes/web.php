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


Auth::routes();

Route::get('/', 'ProductController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', 'OrderController@index');
	Route::get('/order/preview/{id}', 'OrderController@preview')->name('order.preview');
	Route::resource('order', 'OrderController')->except([
		'index'
	]);

});