<?php

namespace Lazada\OpenPlatform\Request\Authorization;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Authorization\RefreshAccessTokenResponse;

class RefreshAccessTokenRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::SYSTEM_REFRESH_ACCESS_TOKEN_URI;

    public function getData()
    {
        $data = parent::getData();

        $this->validate('refreshToken');

        $data = $this->mergeData($data, [
            'refresh_token' => $this->getRefreshToken()
        ]);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new RefreshAccessTokenResponse($this, parent::sendData($data));
    }

    public function getRefreshToken()
    {
        return $this->getParameter("refreshToken");
    }

    public function setRefreshToken($value)
    {
        return $this->setParameter("refreshToken", $value);
    }

    public function getRequestUrl()
    {
        return LazopEndpoint::apiEndpoint('oauth', $this->apiEndpointUri);
    }
}
