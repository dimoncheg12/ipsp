<?php

namespace Ipsp\API;

use Ipsp\IpspResource;

/**
 * Class Ipsp_Resource_Refund
 */
class Reports extends IpspResource
{

    protected $path = '/reports';
    protected $fields = [
        'merchant_id' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'date_from' => [
            'type' => 'string',
            'format' => '',
            'required' => TRUE
        ],
        'date_to' => [
            'type' => 'string',
            'format' => '',
            'required' => TRUE
        ],
        'signature' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'version' => [
            'type' => 'string',
            'required' => FALSE
        ],
    ];

}