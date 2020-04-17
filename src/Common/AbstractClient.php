<?php

namespace Lazada\OpenPlatform\Common;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;

abstract class AbstractClient
{
    protected $parameters;

    protected $httpClient;

    public function __construct(ClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?: $this->getDefaultHttpClient();
        $this->initialize();
    }

    public function initialize(array $parameters = array())
    {
        $this->parameters = array();

        // set default parameters
        foreach ($this->getDefaultParameters() as $key => $value) {
            if (is_array($value)) {
                $this->parameters[$key] = reset($value);
            } else {
                $this->parameters[$key] = $value;
            }
        }

        Helper::initialize($this, $parameters);

        return $this;
    }

    public function getDefaultParameters()
    {
        return [
            'appID' => '',
            'appSecret' => ''
        ];
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getParameter($key, $default = false)
    {
        return $this->parameters[$key] ?? $default;
    }

    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;

        return $this;
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

    public function setAppId($appid)
    {
        $this->setParameter("appID", $appid);
        return $this;
    }

    public function getAppSecret()
    {
        return $this->getParameter("appSecret");
    }

    public function setAppSecret($secret)
    {
        $this->setParameter("appSecret", $secret);
        return $this;
    }

    public function getAppName()
    {
        return $this->getParameter('appName');
    }

    public function setAppName($appname)
    {
        return $this->setParameter('appName', $appname);
    }

    public function getAccessToken()
    {
        return $this->getParameter("accessToken");
    }

    public function setAccessToken($value)
    {
        return $this->setParameter("accessToken", $value);
    }

    public function setHttpClient(ClientInterface $client)
    {
        $this->httpClient = $client;
        return $this;
    }

    protected function createRequest($class, array $parameters)
    {
        $obj = new $class($this->httpClient);

        return $obj->initialize(array_replace($this->getParameters(), $parameters));
    }

    protected function getDefaultHttpClient()
    {
        return new GuzzleClient([
            'allow_redirects' => false,
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            'http_errors' => true,
            'verify' => false
        ]);
    }
}
