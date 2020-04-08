<?php

Route::group(['namespace' => 'Pharmacy'], function() {

    Route::group(["middleware"=>"pharmacy.auth"],function(){
        // Dashboard
        Route::get('/', 'HomeController@index')->name('pharmacy.home')
                ->middleware('emails.verified');
        // Verify Email
        Route::get('email/verify', 'Auth\VerificationController@show')
                    ->name('pharmacy.verification.notice');
        Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')
                    ->name('pharmacy.verification.verify')->middleware(['signed','throttle:6,1']);
        Route::post('email/resend', 'Auth\VerificationController@resend')
                    ->name('pharmacy.verification.resend')->middleware('throttle:6,1');
    });
    
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('pharmacy.logout');

    Route::group(["middleware"=>["admin.guest","doctor.guest","pharmacy.guest"]],function ()
    {
         // Login
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('pharmacy.login');
        // Reset Password
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
            ->name('pharmacy.password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
            ->name('pharmacy.password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
            ->name('pharmacy.password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')
            ->name('pharmacy.password.update');
    });
    
    
});
