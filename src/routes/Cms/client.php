
<?php

Route::group([
    'namespace' => 'Cms',
    'prefix' => 'cms',
    'as' => 'cms.'
], function() {


    Route::group([ 'prefix' => 'client',  'as' => 'client.'], function() {

        Route::get('/menu', 'ClientController@menu')->name('menu');
        Route::get('/create', 'ClientController@create')->name('create');
        Route::get('/index', 'ClientController@index')->name('index');
        Route::post('/store', 'ClientController@store')->name('store');
        Route::get('/edit/{client}', 'ClientController@edit')->name('edit');
        Route::put('/update/{client}', 'ClientController@update')->name('update');
        Route::get('/profile/{client}', 'ClientController@profile')->name('profile');
        Route::get('/show', 'ClientController@show')->name('show');
        Route::delete('/delete/{client}', 'ClientController@delete')->name('delete');
        Route::get('/get_all_for_dt', 'ClientController@getAllForDt')->name('get_all_for_dt');
        Route::get('/get_for_select', 'ClientController@getClientsForSelect')->name('get_for_select');
        Route::post('/quick_store_from_sales', 'ClientController@quickStoreFromSales')->name('quick_store_from_sales');
        Route::get('/get_amount_to_loan_ajax', 'ClientController@getEligibleAmountToLoanAjax')->name('get_amount_to_loan_ajax');
        Route::post('/update_max_loan_limit/{client}', 'ClientController@updateMaxLoanLimit')->name('update_max_loan_limit');
        Route::get('/change_status/{client}','ClientController@changeStatus')->name('change_status');



    });

});



