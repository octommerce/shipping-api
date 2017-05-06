<?php namespace Octommerce\ShippingAPI;

use System\Classes\PluginBase;
use RainLab\User\Models\User;
use Octobro\API\Transformers\UserTransformer;
use Octommerce\API\Transformers\CartTransformer;
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
            $transformer->addFields(['shipping_cost', 'shipping_courier', 'shipping_service']);
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
