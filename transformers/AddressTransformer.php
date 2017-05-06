<?php namespace Octommerce\ShippingAPI\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Shipping\Models\Address;

class AddressTransformer extends Transformer
{
    public function data(Address $address)
    {
        return [
            'id'            => (int) $address->id,
            'location_code' => $address->location_code,
            'address_name'  => $address->address_name,
            'name'          => $address->name,
            'phone'         => $address->phone,
            'street'        => $address->street,
            'latitude'      => (float) $address->latitude,
            'longitude'     => (float) $address->longitude,
            'is_primary'    => (int) $address->is_primary,
        ];
    }
}