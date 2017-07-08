<?php

namespace Ipsp;

/**
 * Class Resource
 */
class IpspResource
{

    protected $method = 'POST';
    protected $format = 'json';
    protected $path;
    protected $fields = [];
    protected $defaultParams = [];
    protected $request;
    protected $response;
    protected $types = [];
    protected $formatter = [
        'json' => 'jsonParams',
        'xml' => 'xmlParams',
        'form' => 'formParams'
    ];
    protected $parser = [
        'json' => 'parseJson',
        'xml' => 'parseXml',
        'form' => 'parseForm'
    ];
    private $client;
    private $params = [];

    /**
     * @param array $params
     * @return string
     */
    private function getSignature($params = [])
    {
        $params = array_filter($params, 'strlen');
        ksort($params);
        $params = array_values($params);
        array_unshift($params, $this->client->getPassword());
        $params = join('|', $params);
        return (sha1($params));
    }

    /**
     * @param string $json
     * @return mixed
     */
    private function parseJson($json = '')
    {
        $data = json_decode($json, TRUE);
        return $data['response'];
    }

    /**
     * @param string $xml
     * @return array
     */
    private function parseXml($xml = '')
    {
        $xml = new IpspXmlData($xml);
        $data = $xml->xmlToArray();
        return $data;
    }

    /**
     * @param string $query
     * @return array
     */
    private function parseForm($query = '')
    {
        $data = array();
        parse_str($query, $data);
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     * @throws IpspException
     */
    protected function parseRespose($data)
    {
        $callback = $this->parser[$this->format];
        if (method_exists($this, $callback)) {
            return call_user_func(array($this, $callback), $data);
        } else {
            throw new \Exception(sprintf('parser %s not supported', $this->format));
        }
    }

    /**
     * @param array $params
     * @return string
     */
    private function jsonParams($params = [])
    {
        return json_encode([
            'request' => $params
        ]);
    }

    /**
     * @param array $params
     * @return string
     */
    private function formParams($params = [])
    {
        return http_build_query($params);
    }

    /**
     * @param array $params
     * @return mixed
     */
    private function xmlParams($params = [])
    {
        $xml = new IpspXmlData('<request/>');
        $xml->arrayToXml($params);
        return $xml->asXML();
    }

    /**
     * @param $params
     * @return mixed
     * @throws IpspException
     */
    protected function buildParams($params = [])
    {
        $callback = $this->formatter[$this->format];
        if (method_exists($this, $callback)) {
            return call_user_func(array($this, $callback), $params);
        } else {
            throw new \Exception(sprintf('format %s not supported', $this->format));
        }
    }

    public function __construct()
    {
        $this->request = new IpspRequest();
        if (!empty($this->defaultParams))
            $this->params = $this->defaultParams;
    }

    /**
     * @param IpspClient $client
     */
    public function setClient(IpspClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param $params
     * @return bool
     */
    public function isValid($params)
    {
        $fields = $this->fields;
        return TRUE;
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public function isValidParam($key, $value)
    {
        return true;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams($params = [])
    {
        if ($this->isValid($params)) {
            $this->params = array_merge($this->params, $params);
        }
        return $this;
    }

    /**
     * @param String $key
     * @param $value
     * @return $this
     */
    public function setParam($key, $value)
    {
        if ($this->isValidParam($key, $value)) {
            $this->params[$key] = $value;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        $params = $this->params;
        $params['merchant_id'] = $this->client->getId();
        $params['signature'] = $this->getSignature($params);
        return $params;
    }

    public function getParam($key)
    {
        return isset($this->params[$key]) ? $this->params[$key] : NULL;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return sprintf('%s%s', $this->client->getUrl(), $this->path);
    }

    /**
     * @return $this
     * @throws IpspException
     */
    public function call($params = [])
    {
        $this->setParams($params);
        $this->request->setFormat($this->format);
        $data = $this->request->doPost($this->getUrl(), $this->buildParams($this->getParams()));
        $data = $this->parseRespose($data);
        $this->setResponse($data);
        return $this;
    }

    /**
     * @param array $data
     */
    public function setResponse($data = [])
    {
        $this->response = new IpspResponse($data);
    }

    /**
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

}