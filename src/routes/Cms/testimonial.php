
<?php

Route::group([
    'namespace' => 'Cms',
    'prefix' => 'cms',
    'as' => 'cms.'
], function() {


    Route::group([ 'prefix' => 'testimonial',  'as' => 'testimonial.'], function() {

        Route::get('/menu', 'ClientTestimonialController@menu')->name('menu');
        Route::get('/index', 'ClientTestimonialController@index')->name('index');
        Route::get('/create', 'ClientTestimonialController@create')->name('create');
        Route::post('/store', 'ClientTestimonialController@store')->name('store');
        Route::get('/edit/{client_testimonial}', 'ClientTestimonialController@edit')->name('edit');
        Route::put('/update/{client_testimonial}', 'ClientTestimonialController@update')->name('update');
        Route::get('/profile/{client_testimonial}', 'ClientTestimonialController@profile')->name('profile');
        Route::delete('/delete/{client_testimonial}', 'ClientTestimonialController@delete')->name('delete');
        Route::get('/get_all_for_dt', 'ClientTestimonialController@getAllForDt')->name('get_all_for_dt');
        Route::get('/get_client_testimonial_for_dt/{client}', 'ClientTestimonialController@getClientDiscountForDt')->name('get_client_testimonial_for_dt');
        /*Shift*/

    });

});
