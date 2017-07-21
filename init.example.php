<?php
require_once 'vendor/autoload.php';

use Ipsp\IpspApi;
use Ipsp\IpspClient;

define('MERCHANT_ID', 1396424);
define('MERCHANT_PASSWORD', 'test');
define('IPSP_GATEWAY', 'api.fondy.eu');
$client = new IpspClient(MERCHANT_ID, MERCHANT_PASSWORD, IPSP_GATEWAY);
$ipsp = new IpspApi($client);
$data = $ipsp->call('verification', array(
    'order_id' => time(),
    'order_desc' => 'Short Order Description',
    'currency' => $ipsp::UAH,
    'amount' => 100, // 1 UAH
    'response_url' => 'http://your-store.com/success'
))->getResponse();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <script src="//api.fondy.eu/static_common/v1/checkout/ipsp.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
        crossorigin="anonymous"></script>
    <script>
        function checkoutInit(url) {
            $ipsp('checkout').scope(function () {
                this.setCheckoutWrapper('#checkout_wrapper');
                this.addCallback(__DEFAULTCALLBACK__);
                this.action('show', function (data) {
                    $('#checkout_loader').remove();
                    $('#checkout').show();
                });
                this.action('hide', function (data) {
                    $('#checkout').hide();
                });
                this.action('resize', function (data) {
                    $('#checkout_wrapper').width(480).height(data.height);
                });
                this.loadUrl(url);
            });
        };
        checkoutInit('<?=$data->checkout_url?>');
    </script>
</head>
<body id="body">
<div id="checkout">
    <div id="checkout_wrapper"></div>
</div>
</body>
</html>