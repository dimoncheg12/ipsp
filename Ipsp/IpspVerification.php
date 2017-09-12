<?php

namespace Ipsp;
/**
 * Class Verification
 * @package Ipsp
 */
class IpspVerification
{
    private $password;
    private $merchant_id;

    /**
     * Set merchant password
     * @param String $password
     * @return mixed
     */
    public function __construct($id, $password)
    {
        if (empty($id) or is_string($id)) throw new \Exception('auth id not set or incorrect');
        if (empty($password)) throw new \Exception('auth password not set');
        $this->merchant_id = $id;
        $this->password = $password;
    }

    /**
     * Generate request params signature
     * @param array $params
     * @return string
     */
    public function generate(Array $params)
    {
        $params['merchant_id'] = $this->merchant_id;
        $params = array_filter($params, 'strlen');
        ksort($params);
        $params = array_values($params);
        array_unshift($params, $this->password);
        $params = join('|', $params);
        return (sha1($params));
    }

    /**
     * Sign params with signature
     * @param array $params
     * @return array
     */
    public function sign(Array $params)
    {
        if (array_key_exists('signature', $params)) return $params;
        $params['signature'] = $this->generate($params);
        return $params;
    }

    /**
     * Clean array params
     * @param array $data
     * @return array
     */
    public function clean(Array $params)
    {
        if (array_key_exists('response_signature_string', $params))
            unset($params['response_signature_string']);
        unset($params['signature']);
        return $params;
    }

    /**
     * Check response params signature
     * @param array $response
     * @return bool
     */
    public function check(Array $response)
    {
        if (!array_key_exists('signature', $response)) throw new \Exception('signature undefined');
        if ($this->merchant_id != $response['merchant_id']) throw new \Exception('mid is incorrect');
        $signature = $response['signature'];
        $response = $this->clean($response);
        return $signature == $this->generate($response);
    }
}