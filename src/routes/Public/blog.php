
<?php

Route::group([
    'namespace' => 'Resource',
    'prefix' => 'resource',
], function() {
    Route::group([ 'prefix' => 'blog',  'as' => 'blog.'], function() {
        Route::get('/','BlogController@index')->name('blog');
        Route::get('/show/{blog}','BlogController@show')->name('show');
    });
});



