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

Route::group(['prefix' => 'dashboard'], function () {
	Route::resource('pharmacies', 'Dashboard\PharmacyController');
	Route::resource('doctors', 'Dashboard\DoctorController');
	Route::resource('users', 'Dashboard\UserController');
	Route::resource('addresses', 'Dashboard\AddressController');
	Route::resource('medicines', 'Dashboard\MedicineController');
	Route::resource('areas', 'Dashboard\AreaController');
	Route::resource('orders', 'Dashboard\OrderController');
	Route::get('revenues', 'Dashboard\RevenueController@index')->name('revenue');
});

Auth::routes([
	'register' => false
]);