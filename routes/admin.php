<?php

Route::group(['namespace' => 'Admin'], function() {
    // Dashboard

    Route::group(["middleware"=>["admin.auth"]],function(){
        Route::get('/', 'HomeController@index')->name('admin.home')->middleware('admin.password.confirm');
        Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('admin.password.confirm');
        Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
    });

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login')->middleware(["admin.guest","doctor.guest","pharmacy.guest"]);
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

});
