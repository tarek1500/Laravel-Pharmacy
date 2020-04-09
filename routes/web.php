<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Mail\MissuEmail;
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

Route::get('/', function () { return new MissuEmail;})->name('home');

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'as' => 'dashboard.', "middleware"=>["auth:pharmacy,admin,doctor","emails.verified"]], function () {
	Route::get('/', function () { return view('index'); })->name('index');
	Route::resource('pharmacies', 'PharmacyController');
	Route::resource('doctors', 'DoctorController');
	Route::resource('users', 'UserController');
	Route::resource('addresses', 'AddressController');
	Route::resource('medicines', 'MedicineController');
	Route::resource('areas', 'AreaController');
	Route::resource('orders', 'OrderController');
	Route::get('revenues', 'RevenueController@index')->name('revenue.index');
});

Route::get('/test' , function () { return view('createnewpharmacy'); });
// Route::get('/dashboard/doctors/delete/{id}','DoctorController@destroy')->name('doctors.destroy');
