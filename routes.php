<?php

    Route::group([
        'prefix' => 'api/v1',
        'namespace' => 'Octommerce\ShippingAPI\Controllers',
        'middleware' => 'cors'
        ], function() {

            Route::group(['prefix' => 'shipping', 'middleware' => 'oauth'], function() {
                Route::get('addresses', 'Addresses@index');
                Route::post('addresses', 'Addresses@store');
                Route::put('addresses', 'Addresses@update');
                Route::delete('addresses', 'Addresses@destroy');
            });
    });

?>