<?php

Route::group(['middleware' => ['web','auth'],'namespace'=> 'System', 'prefix' => 'district', 'as' => 'district.'], function () {

    Route::get('search', 'DistrictController@search')->name('search');

});
