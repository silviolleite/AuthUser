<?php

Route::group(['as' => 'authuser.', 'middleware' => ['auth', config('authuser.middleware.isVerified')]], function (){
    Route::group(['prefix' => 'admin'], function (){
        Route::resource('users', 'UsersController');
    });
    Route::get('users/settings', 'UserSettingsController@edit')->name('user_settings.edit');
    Route::put('users/settings', 'UserSettingsController@update')->name('user_settings.update');

    Route::get('email-verification/error', 'UserConfirmationController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}', 'UserConfirmationController@getVerification')->name('email-verification.check');
});

