<?php namespace Octommerce\ShippingAPI\Controllers;

use Input;
use Event;
use Octobro\API\Controllers\ApiController;
use Octommerce\Shipping\Models\Address;
use Octommerce\ShippingAPI\Transformers\AddressTransformer;

class Addresses extends ApiController
{

    public function index()
    {
        $addresses = $this->user->addresses;

        return $this->respondwithCollection($addresses, new AddressTransformer);
    }

    public function show($id)
    {
    	$address = $this->user->addresses()->whereId($id)->first();

    	return $this->respondwithItem($address, new AddressTransformer);
    }

    public function store()
    {
        $address          = Address::make(Input::get());
        $address->user_id = $this->user->id;
        $address->save();

        return $this->respondwithItem($address, new AddressTransformer);
    }
}
