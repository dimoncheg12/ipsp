<?php

namespace Ipsp\Resource;

use Ipsp\Resource;

/**
 * Class Ipsp_Resource_Refund
 */
class Verification extends Resource{

    protected $path   = '/checkout/url';
    protected $defaultParams = array(
        'subscription'=>'Y'
    );
    protected $fields = array(
        'merchant_id'=>array(
            'type'    => 'string',
            'required'=>TRUE
        ),
        'order_id'=>array(
            'type'    => 'string',
            'required'=>TRUE
        ),
        'currency' => array(
            'type' => 'string',
            'required'=>TRUE
        ),
        'amount' => array(
            'type' => 'integer',
            'required'=>TRUE
        ),
        'subscription'=>array(
            'type' => 'string',
            'equal'=> 'y'
        ),
        'signature' => array(
            'type' => 'string',
            'required'=>TRUE
        ),
        'version' => array(
            'type' => 'string',
            'required'=>FALSE
        )
    );
}