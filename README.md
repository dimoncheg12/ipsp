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

## Check response sign

```php
<?php
require_once 'vendor/autoload.php';

use Ipsp\IpspVerification;

define('MERCHANT_ID', 1396424);
define('MERCHANT_PASSWORD', 'test'); 

$verify = new IpspVerification(MERCHANT_ID, MERCHANT_PASSWORD);

echo 'result '; var_dump($verify->check($_POST));

```

## Generate Checkout

```php
<?php
require_once 'vendor/autoload.php';

use Ipsp\IpspApi;
use Ipsp\IpspClient;

define('MERCHANT_ID', 1396424);
define('MERCHANT_PASSWORD', 'test');
define('IPSP_GATEWAY', 'api.fondy.eu');
$client = new IpspClient(MERCHANT_ID, MERCHANT_PASSWORD, IPSP_GATEWAY);
$ipsp = new IpspApi($client);
$data = array(
    'order_id' => time(),
    'order_desc' => 'Order Description',
    'currency' => $ipsp::UAH,
    'amount' => 100, // 1 UAH
    'response_url' => 'http://psr4/callback.php',
    'server_callback_url' => 'http://psr4/callback.php'
);
$data = $ipsp->call('checkout', $data)->getResponse();
```