<?php

namespace Lazada\OpenPlatform\Request;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Common\Message\AbstractRequest;
use Lazada\OpenPlatform\Exception\RuntimeException;

class AbstractLazopRequest extends AbstractRequest
{
    protected $signMethod = 'sha256';

    protected $apiEndpointUri;

    protected $requireAuthorization = false;

    public function getServiceLocale()
    {
        return $this->getParameter("serviceLocale");
    }

    public function setServiceLocale($value)
    {
        if (LazopEndpoint::hasLocale($value)) {
            return $this->setParameter("serviceLocale", $value);
        } else {
            throw new RuntimeException("The service locale which is {$value} not found.");
        }
    }

    public function getRequestUrl()
    {
        return LazopEndpoint::apiEndpoint($this->getParameter("serviceLocale"), $this->apiEndpointUri);
    }

    public function getRequestMethod()
    {
        return 'POST';
    }

    public function getRequestBody($data = null)
    {
        if (!$data) {
            $data = $this->getData();
        }

        return http_build_query($data);
    }

    public function getData()
    {
        $this->validate(
            'appID',
            'appSecret'
        );

        $data = [
            'app_key' => $this->getAppId(),
            'timestamp' => sprintf("%s000", time()),
            'sign_method' => $this->signMethod
        ];

        if ($this->requireAuthorization) {
            $this->validate('accessToken');
            $data['access_token'] = $this->getAccessToken();
        }

        return $data;
    }

    public function sendData($data)
    {
        $url = $this->getRequestUrl();
        $method = $this->getRequestMethod();
        $body = $this->getRequestBody($data);

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8'
        ];

        $options = [
            'headers' => $headers
        ];

        if (strtolower($method) == 'get') {
            $url = $url . "?" . $body;
        } else {
            $options['body'] = $body;
        }

        $response = $this->httpClient->request($method, $url, $options);

        $responseCode = $response->getStatusCode();
        if ($responseCode == 200) {
            return json_decode($response->getBody()->getContents(), true);
        } else {
            throw new \Exception($response->getReasonPhrase(), $responseCode);
        }
    }

    public function sign($uri, $data)
    {
        if (isset($data['sign'])) {
            unset($data['sign']);
        }

        ksort($data);

        $strToHash = $uri;
        foreach ($data as $k => $v) {
            $strToHash .= "$k$v";
        }
        unset($k, $v);

        return hash_hmac($this->signMethod, $strToHash, $this->getAppSecret());
    }

    protected function arrayToString(array $arr, $itemType = 'string')
    {
        $formatFunc = 'strval';
        switch ($itemType) {
            case 'int':
            case 'integer':
                $formatFunc = 'intval';
                break;
        }

        array_walk($arr, function (&$v) use ($formatFunc) {
            $v = $formatFunc($v);
        });

        return json_encode($arr);
    }
}
