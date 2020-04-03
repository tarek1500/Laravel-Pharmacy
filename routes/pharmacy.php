<?php

Route::group(['namespace' => 'Pharmacy'], function() {
    // Dashboard
    Route::get('/', 'HomeController@index')->name('pharmacy.home');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('pharmacy.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('pharmacy.logout');

  
    // Reset Password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('pharmacy.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('pharmacy.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('pharmacy.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('pharmacy.password.update');

    // Confirm Password
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('pharmacy.password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // Verify Email
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('pharmacy.verification.notice');
    // Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('pharmacy.verification.verify');
    // Route::post('email/resend', 'Auth\VerificationController@resend')->name('pharmacy.verification.resend');
});
