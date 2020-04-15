<?php

namespace Lazada\OpenPlatform\Request\Authorization;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Authorization\GenerateAccessTokenResponse;

class GenerateAccessTokenRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::SYSTEM_GENERATE_ACCESS_TOKEN_URI;

    public function getData()
    {
        $data = parent::getData();

        $this->validate('code');

        $data = $this->mergeData($data, [
            'code' => $this->getCode(),
            'uuid' => $this->getUUID()
        ]);

        $data = $this->filterData($data);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new GenerateAccessTokenResponse($this, parent::sendData($data));
    }

    public function getCode()
    {
        return $this->getParameter("code");
    }

    public function setCode($value)
    {
        return $this->setParameter("code", $value);
    }

    public function getUUID()
    {
        return $this->getParameter("uuid");
    }

    public function setUUID($value)
    {
        return $this->setParameter("uuid", $value);
    }

    public function getRequestUrl()
    {
        return LazopEndpoint::apiEndpoint('oauth', $this->apiEndpointUri);
    }
}
