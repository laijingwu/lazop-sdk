<?php

namespace Lazada\OpenPlatform\Request\Authorization;

use Lazada\OpenPlatform\Common\Message\AbstractRequest;
use Lazada\OpenPlatform\Response\Authorization\RedirectAuthorizeResponse;

class RedirectAuthorizeRequest extends AbstractRequest
{
    public function getRedirectUrl()
    {
        return $this->getParameter("redirectUrl");
    }

    public function setRedirectUrl($value)
    {
        return $this->setParameter("redirectUrl", $value);
    }

    public function isForceAuth()
    {
        return boolval($this->getParameter("forceAuth", false));
    }

    public function setForceAuth(bool $value)
    {
        return $this->setParameter("forceAuth", $value);
    }

    public function getState()
    {
        return $this->getParameter("state");
    }

    public function setState($value)
    {
        return $this->setParameter("state", $value);
    }

    public function getUUID()
    {
        return $this->getParameter("uuid");
    }

    public function setUUID($value)
    {
        return $this->setParameter("uuid", $value);
    }

    public function getCountry()
    {
        return $this->getParameter("country");
    }

    public function setCountry($value)
    {
        return $this->setParameter("country", $value);
    }

    public function getData()
    {
        $this->validate(
            'appID',
            'appSecret',
            'redirectUrl'
        );

        $data = [
            'client_id' => $this->getAppId(),
            'redirect_uri' => $this->getRedirectUrl(),
            'response_type' => 'code',
            'force_auth' => $this->isForceAuth() ? 'true' : '',
            'state' => $this->getState(),
            'uuid' => $this->getUUID(),
            'country' => $this->getCountry()
        ];

        $data = $this->filterData($data);

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new RedirectAuthorizeResponse($this, $data);
    }
}
