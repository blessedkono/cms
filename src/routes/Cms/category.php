
<?php

Route::group([
    'namespace' => 'Cms',
    'prefix' => 'cms',
    'as' => 'cms.'
], function() {




    Route::group([ 'prefix' => 'category',  'as' => 'category.'], function() {

        Route::get('/index', 'BlogCategoryController@index')->name('index');
        Route::get('/create', 'BlogCategoryController@create')->name('create');
        Route::post('/store', 'BlogCategoryController@store')->name('store');
        Route::get('/edit/{blog_category}', 'BlogCategoryController@edit')->name('edit');
        Route::put('/update/{blog_category}', 'BlogCategoryController@update')->name('update');
        Route::delete('/delete/{blog_category}', 'BlogCategoryController@delete')->name('delete');
        Route::get('/get_all_for_dt', 'BlogCategoryController@getAllForDt')->name('get_all_for_dt');
        Route::get('/profile/{blog_category}', 'BlogCategoryController@profile')->name('profile');

        Route::get('/change_status/{blog_category}','BlogCategoryController@changeStatus')->name('change_status');

    });

});



