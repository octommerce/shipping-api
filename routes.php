<?php

    Route::group([
        'prefix' => 'api/v1',
        'namespace' => 'Octommerce\ShippingAPI\Controllers',
        'middleware' => 'cors'
        ], function() {

            Route::group(['middleware' => 'oauth'], function() {
                Route::put('cart/shipping', 'Cart@updateShipping');

                Route::group(['prefix' => 'shipping'], function() {

                    Route::get('addresses', 'Addresses@index');
                    Route::post('addresses', 'Addresses@store');
                    Route::put('addresses', 'Addresses@update');
                    Route::delete('addresses', 'Addresses@destroy');
                });
            });
    });

?>