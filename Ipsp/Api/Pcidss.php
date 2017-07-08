<?php

namespace Ipsp\API;

use Ipsp\IpspResource;

/**
 * Class Ipsp_Resource_PaymentPcidss
 */
class Pcidss extends IpspResource
{
    protected $path = '/3dsecure_step1';
    protected $fields = [
        'order_id' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'order_desc' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'currency' => [
            'type' => 'string',
            'required' => TRUE
        ],
        'amount' => [
            'type' => 'datetime',
            'required' => TRUE
        ],
        'card_number' => [
            'type' => 'creditcard',
            'required' => TRUE
        ],
        'cvv2' => [
            'type' => 'cvv',
            'required' => TRUE
        ],
        'expiry_date' => [
            'type' => 'datetime',
            'required' => TRUE
        ]
    ];

    public function acsRedirect()
    {
        $response = $this->response;
        if (!$response->acs_url) return FALSE;
        $data = [
            'PaReq' => $response->pareq,
            'MD' => $response->md,
            'TermUrl' => $this->getParam('response_url')
        ];
        $html = "<html><body><form id='form' action='$response->acs_url' method='post'>";
        foreach ($data as $key => $value)
            $html .= "<input type='hidden' name='$key' value='$value'>";
        $html .= "</form><script>document.getElementById('form').submit();</script>";
        $html .= "</body></html>";
        exit($html);
    }

}