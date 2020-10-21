<?php

Route::group([
    'middleware' => ['web','auth'],
    'namespace' => 'System',
    'prefix' => 'admin'
], function() {


    Route::resource('sysdef', 'SysdefController', ['except' => ['show']]);

    Route::group([ 'prefix' => 'sysdef',  'as' => 'sysdef.'], function() {
        Route::get('/definitions/{sysdef_group}', 'SysdefController@getSysdefsForDataTable')->name('definitions');
    });

});



