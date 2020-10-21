<?php

Route::group([
    'namespace' => 'Cms',
    'prefix' => 'cms',
    'as'=> 'cms.'
], function() {
    Route::group([ 'prefix' => 'dashboard',  'as' => 'dashboard.'], function() {
        Route::get('/', 'DashboardController@index')->name('index');
    });
});


