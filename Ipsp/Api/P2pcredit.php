<?php

namespace Ipsp\API;

use Ipsp\IpspResource;

/**
 * Class Ipsp_Resource_Refund
 */
class P2pcredit extends IpspResource {
    protected $path   = '/p2pcredit';
    protected $fields = [
        'merchant_id'=>[
            'type'    => 'string',
            'required'=>TRUE
        ],
        'order_id'=>[
            'type'    => 'string',
            'required'=>TRUE
        ],
        'order_desc'=>[
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
        'receiver_card_number'=>[
            'type' => 'string',
            'required'=>FALSE
        ],
        'receiver_rectoken'=>[
            'type' => 'string',
            'required'=>FALSE
        ],
        'signature' => [
            'type' => 'string',
            'required'=>TRUE
        ],
        'version' => [
            'type' => 'string',
            'required'=>FALSE
        ]
    ];
}