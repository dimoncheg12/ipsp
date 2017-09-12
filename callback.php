<?php
require_once 'vendor/autoload.php';

use Ipsp\IpspVerification;

define('MERCHANT_ID', 1396424);
define('MERCHANT_PASSWORD', 'test'); 

$verify = new IpspVerification(MERCHANT_ID, MERCHANT_PASSWORD);

echo 'result '; var_dump($verify->check($_POST));
?>