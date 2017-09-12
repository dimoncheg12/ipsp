<?php

namespace Ipsp\API;

use Ipsp\IpspResource;

/**
 * Class Ipsp_Resource_Transactions
 */
class TransactionList extends IpspResource
{

    protected $path = '/transaction_list';
    protected $fields = [
        'order_id' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'merchant_id' => [
            'type' => 'int',
            'required' => TRUE
        ],
        'signature' => [
            'type' => 'string',
            'required' => TRUE
        ]
    ];
}