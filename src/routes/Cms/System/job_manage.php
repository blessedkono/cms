<?php

Route::group([
    'middleware' => ['web','auth'],
    'namespace' => 'System',
    'prefix' => 'admin',
    'as' => 'system.'
], function() {


/* JOBS*/

    Route::get('/manage_jobs', 'JobManageController@index')->name('manage_jobs');

    Route::group([ 'prefix' => 'job',  'as' => 'job.'], function() {
        Route::get('/index', 'JobManageController@viewActiveJobsPage')->name('index');
        Route::get('/get_for_datatable', 'JobManageController@getActiveJobsForDt')->name('get_for_datatable');
        Route::get('/show/{job}', 'JobManageController@showJob')->name('show');
        Route::delete('/delete/{job}', 'JobManageController@deleteJob')->name('delete');
        Route::get('/delete_all/{job}', 'JobManageController@deleteAllJobs')->name('delete_all');
    });



    /*FAILED JOBS*/

    Route::group([ 'prefix' => 'failed_job',  'as' => 'failed_job.'], function() {
        Route::get('/index', 'JobManageController@viewFailedJobsPage')->name('index');
        Route::get('/get_for_datatable', 'JobManageController@getFailedJobsForDt')->name('get_for_datatable');
        Route::get('/show/{failed_job}', 'JobManageController@showFailedJob')->name('show');
        Route::delete('/delete/{failed_job}', 'JobManageController@deleteFailedJob')->name('delete');
        Route::get('/delete_all/{failed_job}', 'JobManageController@deleteAllFailedJobs')->name('delete_all');
    });


});



