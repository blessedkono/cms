<?php

Route::group([
    'middleware' => ['web','auth'],
    'namespace' => 'System',
    'prefix' => 'admin',
    'as' => 'system.'
], function() {




    Route::group([ 'prefix' => 'document_resource',  'as' => 'document_resource.'], function() {
        Route::get('attach/{resource}', 'DocumentResourceController@attachDocument')->name('attach');
        Route::post('store', 'DocumentResourceController@storeDocument')->name('store');
        Route::get('edit/{doc_pivot_id}', 'DocumentResourceController@editDocument')->name('edit');
        Route::put('update', 'DocumentResourceController@updateDocument')->name('update');
        Route::get('delete/{doc_pivot_id}', 'DocumentResourceController@deleteDocumentWithReturn')->name('delete');
        Route::get('preview/{doc_pivot_id}', 'DocumentResourceController@previewDocument')->name('preview');
        Route::get('open/{doc_pivot_id}', 'DocumentResourceController@openDocument')->name('open');
    });





});



