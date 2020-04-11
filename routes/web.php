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

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'as' => 'dashboard.', "middleware"=>["auth:pharmacy,admin,doctor","emails.verified","banned"]], function () {
	Route::get('/', function () { return view('index'); })->name('index');

	Route::group(["middleware"=>"role:admin"],function(){
		Route::get('pharmacies/trash', 'PharmacyController@trash')->name('pharmacies.trash');
		Route::get('pharmacies/{pharmacy}/restore', 'PharmacyController@restore')->name('pharmacies.restore');
		Route::resource('pharmacies', 'PharmacyController');
		Route::resource('users', 'UserController');
		Route::resource('addresses', 'AddressController');
		Route::resource('areas', 'AreaController');
	});
	Route::group(["middleware"=>"role:pharmacy"],function(){
		Route::resource('doctors', 'DoctorController');
		Route::get('revenues', 'RevenueController@index')->name('revenue.index');
	});
	
	Route::resource('medicines', 'MedicineController');
	Route::resource('orders', 'OrderController');
	Route::post('payment', 'PaymentController@charge')->name('payment.charge');
	Route::get('profile','ProfileController@edit')->name('profile.edit');
	Route::put('profile','ProfileController@update')->name('profile.update');
});