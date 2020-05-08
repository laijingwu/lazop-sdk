<?php

namespace Lazada\OpenPlatform\Request\DataMoat;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\DataMoat\ComputeRiskResponse;

class ComputeRiskRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::DATA_MOAT_COMPUTE_RISK_URI;

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
            'userIP',
            'ati'
        );

        $data = $this->mergeData($data, [
            'time' => strval(time() * 1000),
            'appName' => $this->getAppName(),
            'userId' => strval($this->getUserId()),
            'userIp' => $this->getUserIP(),
            'ati' => $this->getAti()
        ]);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new ComputeRiskResponse($this, parent::sendData($data));
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
}
