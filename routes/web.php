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
	Route::get('/home', 'OrderController@index')->name('order.list');
	Route::get('/order/preview/{order}', 'OrderController@preview')->name('order.preview');
	Route::resource('order', 'OrderController')->except([
		'index'
	]);

	Route::get('/buy/create', 'BuyController@create')->name('buy.create');
	Route::post('/buy', 'BuyController@store')->name('buy.store');
	Route::get('/buy/preview/{order}', 'BuyController@preview')->name('buy.preview');

});