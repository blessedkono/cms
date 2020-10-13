<?php

Route::group([
    'namespace' => 'Nextbyte\Cms\Http\Controllers\Cms',
    'prefix' => 'cms',
    'as'=> 'cms.'
], function() {
    Route::group([ 'prefix' => 'dashboard',  'as' => 'dashboard.'], function() {
        Route::get('/', 'DashboardController@index')->name('index');
    });
});


