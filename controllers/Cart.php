<?php namespace Octommerce\ShippingAPI\Controllers;

use Event;
use Cart as CartHelper;
use ApplicationException;
use Octobro\API\Classes\ApiController;
use Octommerce\Shipping\Models\Address;
use Octommerce\Shipping\Classes\CourierManager;
use Octommerce\API\Transformers\CartTransformer;

class Cart extends ApiController
{
    public function updateShipping()
    {
        $cart = CartHelper::get();

        $courierManager = CourierManager::instance();

        $courier = $courierManager->findByAlias($this->input->get('courier'), true);

        if (!$courier) {
            throw new ApplicationException('Courier \'' . $this->input->get('courier') . '\' not found.');
        }

        $shippingData = [
            'cost'    => $courier->getShippingCost($this->data, $cart),
            'courier' => $this->input->get('courier'),
            'service' => $this->input->get('service')
        ];

        $cart->addShippingCost($shippingData);

        return $this->respondWithItem($cart, new CartTransformer);
    }

}
