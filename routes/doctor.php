<?php

Route::group(['namespace' => 'Doctor'], function() {
    
    Route::group(["middleware"=>["doctor.auth","banned"]],function(){
         // Dashboard
        Route::get('/', 'HomeController@index')->name('doctor.home')
                ->middleware('emails.verified');
    
        // Verify Email
        Route::get('email/verify', 'Auth\VerificationController@show')
                ->name('doctor.verification.notice');
        Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')
                ->name('doctor.verification.verify')->middleware(['signed','throttle:6,1']);
        Route::post('email/resend', 'Auth\VerificationController@resend')
                ->name('doctor.verification.resend')->middleware('throttle:6,1');
    });
   
       
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('doctor.logout');

    Route::group(["middleware"=>["admin.guest","doctor.guest","pharmacy.guest"]], function(){
        
        // Login
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('doctor.login');
        
        // Reset Password
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
                ->name('doctor.password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
                ->name('doctor.password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
                ->name('doctor.password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')
                ->name('doctor.password.update');

    });
   
});
