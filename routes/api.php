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

Route::get('login', 'API\AuthController@login')->name('api.login');
Route::get('register', 'API\AuthController@register')->name('api.register');
Route::put('users/profile', 'API\UserController@update')->name('api.users.profile');
Route::resource('addresses', 'API\AddressController');
Route::resource('orders', 'API\OrderController')->only(['index', 'store', 'show', 'update']);