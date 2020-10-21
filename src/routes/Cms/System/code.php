
<?php

Route::group([
    'namespace' => 'System',
    'prefix' => 'admin'
], function() {


    Route::resource('code', 'CodeController', ['except' => ['show']]);

    Route::group([ 'prefix' => 'code',  'as' => 'code.'], function() {

        Route::get('/values/{code}', 'CodeController@getCodeValues')->name('values');

        Route::get('/values/{code}/add', 'CodeController@codeValueCreate')->name('value.create');
        Route::post('/values/{code}/add', 'CodeController@codeValueStore')->name('value.store');

        Route::get('/value/{code}/edit', 'CodeController@codeValueEdit')->name('value.edit');
        Route::put('/value/{code}/edit', 'CodeController@codeValueUpdate')->name('value.update');
        Route::get('/value/{code}/deactivate', 'CodeController@codeValueDeactivate')->name('value.deactivate');
        Route::get('/value/{code}/activate', 'CodeController@codeValueActivate')->name('value.activate');
    });

});



