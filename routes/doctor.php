<?php

Route::group(['namespace' => 'Doctor'], function() {
    // Dashboard
    Route::get('/', 'HomeController@index')->name('doctor.home');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('doctor.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('doctor.logout');



    // Reset Password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('doctor.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('doctor.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('doctor.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('doctor.password.update');

    // Confirm Password
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('doctor.password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // Verify Email
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('doctor.verification.notice');
    // Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('doctor.verification.verify');
    // Route::post('email/resend', 'Auth\VerificationController@resend')->name('doctor.verification.resend');
});
