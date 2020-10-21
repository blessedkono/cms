<?php

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as'=> 'admin.'
    ], function() {


    Route::group(['namespace' => 'Report',   'prefix' => 'reports', 'as' => 'report.'], function () {
        Route::get('/', 'ReportController@index')->name('index');
        Route::get('/reports_by_group/{report_group}', 'ReportController@openReportsByGroup')->name('reports_by_group');
    });
});



