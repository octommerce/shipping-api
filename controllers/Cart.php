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

        $cart->setShipping($this->input->get('courier'), $this->input->get('service'), $this->data);

        return $this->respondWithItem($cart, new CartTransformer);
    }

}
