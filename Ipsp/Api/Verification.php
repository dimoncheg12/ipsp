<?php

namespace Ipsp\API;

use Ipsp\IpspResource;

/**
 * Class Ipsp_Resource_Refund
 */
class Verification extends IpspResource
{

    protected $path = '/checkout/url';
    protected $defaultParams = [
        'verification' => 'y',
        'verification_type' => 'code'
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
        'verification' => [
            'type' => 'string',
            'equal' => 'y'
        ],
        'verification_type' => [
            'type' => 'string',
            'equal' => 'y',
            'required' => TRUE
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