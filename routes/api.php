<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::group(['namespace' => 'API', 'as' => 'api.'], function () {
	Route::get('login', 'AuthController@login')->name('login');
	Route::get('register', 'AuthController@register')->name('register');
	Route::put('users/profile', 'UserController@update')->name('users.profile');
	Route::resource('addresses', 'AddressController');
	Route::resource('orders', 'OrderController')->only(['index', 'store', 'show', 'update']);
});