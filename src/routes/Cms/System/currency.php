<?php
Route::group(['middleware' => ['web','auth'],'namespace'=> 'System', 'prefix' => 'admin/currency', 'as' => 'currency.'], function () {

    Route::get('all', 'CurrencyController@index')->name('all');
    Route::get('all/datatable', 'CurrencyController@getAllCurrenciesDatatable')->name('all.datatable');
    Route::get('create', 'CurrencyController@create')->name('create');
    Route::post('store', 'CurrencyController@store')->name('store');
    Route::get('view/{id}', 'CurrencyController@show')->name('view');
    Route::get('edit/{id}', 'CurrencyController@edit')->name('edit');
    Route::post('update/{id}', 'CurrencyController@update')->name('update');

});