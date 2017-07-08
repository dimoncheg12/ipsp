<?php

namespace Ipsp\API;

use Ipsp\IpspResource;

/**
 * Class Ipsp_Resource_Refund
 */
class Subscription extends IpspResource
{

    protected $path = '/checkout/url';
    protected $defaultParams = [
        'subscription' => 'Y'
    ];
    protected $fields = [
        'merchant_id' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'order_id' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'currency' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'amount' => [
            'type' => 'integer',
            'required' => TRUE
        ],
        'subscription' => [
            'type' => 'string',
            'equal' => 'y'
        ],
        'signature' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'version' => [
            'type' => 'string',
            'required' => FALSE
        ]
    ];
}