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

Route::get('/', function () { return view('welcome'); })->name('home');

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
	Route::resource('pharmacies', 'PharmacyController');
	Route::resource('doctors', 'DoctorController');
	Route::resource('users', 'UserController');
	Route::resource('addresses', 'AddressController');
	Route::resource('medicines', 'MedicineController');
	Route::resource('areas', 'AreaController');
	Route::resource('orders', 'OrderController');
	Route::get('revenues', 'RevenueController@index')->name('revenue');
});

Auth::routes([
	'register' => false
]);