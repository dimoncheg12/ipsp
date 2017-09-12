# IPSP (PHP) SDK

## Payment service provider
A payment service provider (PSP) offers shops online services for accepting electronic payments by a variety of payment methods including credit card, bank-based payments such as direct debit, bank transfer, and real-time bank transfer based on online banking. Typically, they use a software as a service model and form a single payment gateway for their clients (merchants) to multiple payment methods. 
[read more](https://en.wikipedia.org/wiki/Payment_service_provider)

## Quick Start

```php
<?php
require_once 'vendor/autoload.php';

use Ipsp\IpspApi;
use Ipsp\IpspClient;
define('MERCHANT_ID' , 'your_merchant_id');
define('MERCHANT_PASSWORD' , 'test');
define('IPSP_GATEWAY' , 'your_ipsp_gateway');
$client = new Ipsp_Client( MERCHANT_ID , MERCHANT_PASSWORD, IPSP_GATEWAY );
$ipsp   = new Ipsp_Api( $client );
```

## Generate Signature

```php
<?php
function getSignature( $merchant_id , $password , $params = array() ){
 $params['merchant_id'] = $merchant_id;
 $params = array_filter($params,'strlen');
 ksort($params);
 $params = array_values($params);
 array_unshift( $params , $password );
 $params = join('|',$params);
 return(sha1($params));
}
```

## Generate Checkout

```php
<?php
$order_id = time();
$data = $ipsp->call('checkout',array(
 'order_id'    => $order_id,
 'order_desc'  => 'Short Order Description',
 'currency'    => $ipsp::USD ,
 'amount'      => 2000, // 20 USD
 'response_url'=> sprintf('http://shop.example.com/checkout/%s',$order_id)
))->getResponse();
// redirect to checkoutpage
header(sprintf('Location: %s',$data->checkout_url));
```