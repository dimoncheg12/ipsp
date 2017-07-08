<?php
require_once 'vendor/autoload.php';

use Ipsp\IpspApi;
use Ipsp\IpspClient;
define('MERCHANT_ID' , 1396424);
define('MERCHANT_PASSWORD' , 'test');
define('IPSP_GATEWAY' ,  'api.fondy.eu');
$client = new IpspClient( MERCHANT_ID , MERCHANT_PASSWORD, IPSP_GATEWAY );
$ipsp   = new IpspApi( $client );
$data = $ipsp->call('subscription',array(
    'order_id'    => time(),
    'order_desc'  => 'Short Order Description',
    'currency'    => $ipsp::USD ,
    'amount'      => 1000, // 10 USD
    'response_url'=> 'http://shop.example.com/checkout/'
))->getResponse();
print_r ($data);