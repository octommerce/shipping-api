<?php namespace Octommerce\ShippingAPI\Transformers;

use League\Fractal\TransformerAbstract;
use Octommerce\Shipping\Models\Address;

class AddressTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    protected $availableIncludes = [];

    public function transform(Address $address)
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