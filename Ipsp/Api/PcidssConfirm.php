<?php

namespace Ipsp\API;

use Ipsp\IpspResource;

/**
 * Class Ipsp_Resource_PaymentPcidss
 */
class PcidssConfirm extends IpspResource
{

    protected $path = '/3dsecure_step2';
    protected $fields = [
        'order_id' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'merchant_id' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'pares' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'md' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'version' => [
            'type' => 'cvv',
            'required' => FALSE
        ],
        'signature' => [
            'type' => 'string',
            'required' => TRUE
        ]
    ];
}