<?php

Route::group([
    'namespace' => 'System',
    'middleware' => ['web','auth'],
    'prefix' => 'admin'
], function() {

    Route::group([ 'prefix' => 'country',  'as' => 'country.'], function() {
        Route::get('/', 'CountryController@index')->name('index');
        Route::get('/create', 'CountryController@createCountry')->name('create');
        Route::get('/edit/{country}', 'CountryController@editCountry')->name('edit');

        Route::get('/delete/{country}', 'CountryController@deleteCountry')->name('delete');
        Route::get('/deactivate/{country}', 'CountryController@deactivateCountry')->name('deactivate_country');
        Route::get('/activate/{country}', 'CountryController@activateCountry')->name('activate_country');

        Route::post('/store', 'CountryController@storeCountry')->name('store');
        Route::post('/update/{country}', 'CountryController@updateCountry')->name('update');

        Route::get('/profile/{country}', 'CountryController@profile')->name('profile');
        Route::get('/get_countries', 'CountryController@getCountriesForAdminDatatable')->name('get_countries');
        Route::get('/get_regions/{country}','RegionController@getRegionsForDataTable')->name('get_regions_by_country');

        Route::get('/create_region/{country}','RegionController@createRegion')->name('create_region');
        Route::post('/create_region/store/{country}','RegionController@storeRegion')->name('store_region');

        Route::get('/edit_region/{region}','RegionController@editRegion')->name('edit_region');
        Route::post('/update_region/{region}','RegionController@updateRegion')->name('update_region');

        Route::get('/delete_region/{region}', 'RegionController@deleteRegion')->name('delete_region');
        Route::get('/deactivate_region/{region}', 'RegionController@deactivateRegion')->name('deactivate_region');
        Route::get('/activate_region/{region}', 'RegionController@activateRegion')->name('activate_region');








    });

});