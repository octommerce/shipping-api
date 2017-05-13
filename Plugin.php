<?php namespace Octommerce\ShippingAPI;

use System\Classes\PluginBase;
use RainLab\User\Models\User;
use Octommerce\Octommerce\Models\Cart;
use Octommerce\Octommerce\Models\Order;
use Octobro\API\Transformers\UserTransformer;
use Octommerce\API\Transformers\CartTransformer;
use Octommerce\API\Transformers\OrderTransformer;
use Octommerce\ShippingAPI\Transformers\AddressTransformer;

class Plugin extends PluginBase
{
	public $require = ['Octobro.API', 'Octommerce.Shipping'];

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
    	CartTransformer::extend(function($transformer) {
            $transformer->addField('shipping_cost', function(Cart $cart) {
                return (float) $cart->shipping_cost;
            });

            $transformer->addFields(['shipping_courier', 'shipping_service']);
    	});

		OrderTransformer::extend(function($transformer) {
            $transformer->addField('shipping_cost', function(Order $order) {
                return (float) $order->shipping_cost;
            });

			$transformer->addField('is_cod', function(Order $order) {
                return (Boolean) $order->is_cod;
            });

			$transformer->addField('shipping_latitude', function(Order $order) {
                return (float) $order->shipping_latitude;
            });

			$transformer->addField('shipping_longitude', function(Order $order) {
                return (float) $order->shipping_longitude;
            });

            $transformer->addFields([
				'shipping_courier',
				'shipping_service',
			]);
    	});

        UserTransformer::extend(function($transformer) {
            $transformer->addInclude('addresses', function(User $user) use ($transformer) {
                return $transformer->collection($user->addresses, new AddressTransformer);
            });

            $transformer->addField('addresses_count', function(User $user) {
                return $user->addresses()->count();
            });

        });
    }
}
