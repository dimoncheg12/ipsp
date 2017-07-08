<?php

namespace Ipsp\API;

use Ipsp\IpspResource;

/**
 * Class Ipsp_Resource_PaymentStatus
 */
class Status extends IpspResource
{

    protected $path = '/status/order_id';
    protected $fields = [
        'order_id' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'merchant_id' => [
            'type' => 'string',
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