
<?php

Route::group([
    'namespace' => 'Cms',
    'prefix' => 'cms',
    'as' => 'cms.'
], function() {
    Route::group([ 'prefix' => 'blog',  'as' => 'blog.'], function() {
        Route::get('/','BlogController@index')->name('index');
        Route::get('/create','BlogController@create')->name('create');
        Route::post('/store','BlogController@store')->name('store');
        Route::get('/show/{blog}','BlogController@show')->name('show');
        Route::get('/view_blog','BlogController@viewBlog')->name('view_blog');
        Route::post('/delete','BlogController@delete')->name('delete');
        Route::post('/update','BlogController@update')->name('update');
        Route::get('/edit/{blog}','BlogController@edit')->name('edit');
        Route::get('/get_blog_by_id_for_edit', 'BlogController@getBlogByIdForEdit')->name('get_blog_by_id_for_edit');
        Route::post('/upload_tempo_files', 'BlogController@uploadTemporaryFiles')->name('upload_tempo_files');
        Route::get('/get_all_for_dt', 'BlogController@getAllForDt')->name('get_all_for_dt');
        Route::get('/publish/{blog}', 'BlogController@publish')->name('publish');
        Route::get('/change_status/{blog}', 'BlogController@publish')->name('change_status');



    });
});



