<?php

namespace Lazada\OpenPlatform\Request\DataMoat;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\DataMoat\LoginResponse;

class LoginRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::DATA_MOAT_LOGIN_URI;

    protected $requireAuthorization = false;

    public function getRequestMethod()
    {
        return 'POST';
    }

    public function getRequestUrl()
    {
        return LazopEndpoint::apiEndpoint('common', $this->apiEndpointUri);
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validate(
            'appName',
            'userId',
            'tid',
            'userIP',
            'ati',
            'loginResult',
            'loginMessage'
        );

        $data = $this->mergeData($data, [
            'time' => strval(time() * 1000),
            'appName' => $this->getAppName(),
            'userId' => strval($this->getUserId()),
            'tid' => $this->getTid(),
            'userIp' => $this->getUserIP(),
            'ati' => $this->getAti(),
            'loginResult' => $this->getLoginResult(),
            'loginMessage' => $this->getLoginMessage()
        ]);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new LoginResponse($this, parent::sendData($data));
    }

    public function getTid()
    {
        return $this->getParameter('tid');
    }

    public function setTid($value)
    {
        return $this->setParameter('tid', $value);
    }

    public function getUserId()
    {
        return $this->getParameter('userId');
    }

    public function setUserId($value)
    {
        return $this->setParameter('userId', $value);
    }

    public function getUserIP()
    {
        return $this->getParameter('userIP');
    }

    public function setUserIP($value)
    {
        return $this->setParameter('userIP', $value);
    }

    public function getAti()
    {
        return $this->getParameter('ati');
    }

    public function setAti($value)
    {
        return $this->setParameter('ati', $value);
    }

    public function getLoginResult()
    {
        return $this->getParameter('loginResult');
    }

    public function setLoginResult($value)
    {
        return $this->setParameter('loginResult', $value);
    }

    public function getLoginMessage()
    {
        return $this->getParameter('loginMessage');
    }

    public function setLoginMessage($value)
    {
        return $this->setParameter('loginMessage', $value);
    }
}
