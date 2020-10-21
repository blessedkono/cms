<?php

Route::group([
    'middleware' => ['web','auth'],
    'namespace' => 'System',
    'prefix' => 'admin',
    'as' => 'system.'
], function() {




    Route::group([ 'prefix' => 'audit',  'as' => 'audit.'], function() {
        Route::get('/index', 'AuditManageController@index')->name('index');
        Route::get('/search_page', 'AuditManageController@searchPage')->name('search_page');
        Route::get('/get_for_datatable', 'AuditManageController@getForDt')->name('get_for_datatable');
        Route::get('/show/{audit}', 'AuditManageController@showAudit')->name('show');

    });




});



