<?php

Route::group([
    'namespace' => 'Cms',
    'prefix' => 'cms',
    'as' => 'cms.'
], function() {
    Route::group([ 'prefix' => 'faq',  'as' => 'faq.'], function() {
        Route::get('/index', 'FaqController@index')->name('index');
        Route::get('/create', 'FaqController@create')->name('create');
        Route::post('/store', 'FaqController@store')->name('store');
        Route::put('/update/{faq}', 'FaqController@update')->name('update');
        Route::get('/profile/{faq}', 'FaqController@profile')->name('profile');
        Route::get('/edit/{faq}', 'FaqController@edit')->name('edit');
        Route::get('/delete/{faq}', 'FaqController@destroy')->name('delete');
        Route::get('/profile/{faq}', 'FaqController@profile')->name('profile');
        Route::get('/get/admin_data', 'FaqController@getForAdminDatatable')->name('get.admin_data');
    });

});



