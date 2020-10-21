<?php

Route::group([
    'namespace' => 'Resource',
    'prefix' => 'resource'
], function() {
    Route::group([ 'prefix' => 'general_information',  'as' => 'general_information.'], function() {
        Route::get('/pricing','GeneralInformationController@pricing')->name('pricing');
        Route::get('/about_us','GeneralInformationController@aboutUs')->name('about_us');
        Route::get('/contact_us','GeneralInformationController@contactUs')->name('contact_us');
        Route::post('/contact_us/send','GeneralInformationController@sendMessageToSupportEmail')->name('contact_us.send');
        Route::post('/newsletter_subscription','GeneralInformationController@newsLetterSubscription')->name('newsletter_subscription');

    });
});

