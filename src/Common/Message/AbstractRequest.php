<?php

namespace Lazada\OpenPlatform\Common\Message;

use GuzzleHttp\Client;
use Lazada\OpenPlatform\Common\Helper;
use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Exception\InvalidRequestException;
use Lazada\OpenPlatform\Exception\RuntimeException;

abstract class AbstractRequest implements RequestInterface
{
    protected $parameters;

    protected $httpClient;

    protected $response;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->initialize();
    }

    public function initialize(array $parameters = array())
    {
        if ($this->response !== null) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters = array();

        Helper::initialize($this, $parameters);

        return $this;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getParameter($key, $default = '')
    {
        return $this->parameters[$key] ?? $default;
    }

    public function setParameter($key, $value)
    {
        if ($this->response !== null) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters[$key] = $value;

        return $this;
    }

    public function validate()
    {
        foreach (func_get_args() as $key) {
            if (!isset($this->parameters[$key])) {
                throw new InvalidRequestException("The $key parameter is required");
            }
        }
    }

    public function validateOne()
    {
        $ok = false;
        $args = func_get_args();
        foreach ($args as $key) {
            if (isset($this->parameters[$key])) {
                $ok = true;
            }
        }

        if (!$ok) {
            throw new InvalidRequestException("Nothing parameter, require a parameter in " . implode(", ", $args) . " fields at least");
        }
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function production()
    {
        $this->setTestMode(false);
    }

    public function sandbox()
    {
        $this->setTestMode(true);
    }

    public function getAppId()
    {
        return $this->getParameter("appID");
    }

    public function setAppId($value)
    {
        return $this->setParameter("appID", $value);
    }

    public function getAppSecret()
    {
        return $this->getParameter("appSecret");
    }

    public function setAppSecret($value)
    {
        return $this->setParameter("appSecret", $value);
    }

    public function getAppName()
    {
        return $this->getParameter('appName');
    }

    public function setAppName($value)
    {
        return $this->setParameter('appName', $value);
    }

    public function getAccessToken()
    {
        return $this->getParameter("accessToken");
    }

    public function setAccessToken($value)
    {
        return $this->setParameter("accessToken", $value);
    }

    public function send()
    {
        $data = $this->getData();

        return $this->sendData($data);
    }

    public function getResponse()
    {
        if ($this->response === null) {
            throw new RuntimeException('You must call send() before accessing the Response!');
        }

        return $this->response;
    }

    protected function implodeArray($data)
    {
        if (is_string($data)) {
            return $data;
        }

        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $data[$key] = $this->implodeArray($val);
            }
        }

        return implode('', array_values($data));
    }

    protected function filterData(array $data)
    {
        foreach ($data as $k => $v) {
            if (is_null($v) || $v === '') {
                unset($data[$k]);
            }
        }

        return $data;
    }

    protected function mergeData(array $data, array $_data)
    {
        return array_merge($data, $_data);
    }
}
