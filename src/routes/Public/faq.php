<?php

Route::group([
    'namespace' => 'Resource',
    'prefix' => 'resource',
], function () {
    Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
        Route::get('/', 'FaqController@index')->name('faq');
    });
});

