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
                    Route::get('addresses/{id}', 'Addresses@show');
                    Route::put('addresses/{id}', 'Addresses@update');
                    Route::delete('addresses/{id}', 'Addresses@destroy');
                });
            });
    });

?>
