<?php

namespace Ipsp\API;

use Ipsp\IpspResource;

/**
 * Class Ipsp_Resource_Refund
 */
class Recurring extends IpspResource{

    protected $path   = '/recurring';
    protected $fields = [
        'merchant_id'=>[
            'type'    => 'string',
            'required'=>TRUE
        ],
        'order_id'=>[
            'type'    => 'string',
            'required'=>TRUE
        ],
        'currency' => [
            'type' => 'string',
            'required'=>TRUE
        ],
        'amount' => [
            'type' => 'integer',
            'required'=>TRUE
        ],
        'signature' => [
            'type' => 'string',
            'required'=>TRUE
        ],
        'rectoken' => [
            'type' => 'string',
            'required'=>TRUE
        ],
        'version' => [
            'type' => 'string',
            'required'=>FALSE
        ]
    ];

}