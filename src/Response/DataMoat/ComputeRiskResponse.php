<?php

namespace Lazada\OpenPlatform\Response\DataMoat;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class ComputeRiskResponse extends AbstractLazopResponse
{
    public function isSuccessful()
    {
        return parent::isSuccessful()
            && isset($this->data['result']['success'])
            && $this->data['result']['success'] == 'true';
    }

    public function getResult()
    {
        return $this->data['result'];
    }

    public function getMessage()
    {
        if (parent::isSuccessful() && isset($this->data['result']['msg'])) {
            return $this->data['result']['msg'];
        } else {
            return parent::getMessage();
        }
    }

    public function getRiskRate()
    {
        return $this->data['result']['risk'];
    }

    public function getRiskType()
    {
        return $this->data['result']['riskType'];
    }

    public function getRiskDescription()
    {
        return $this->data['result']['riskDescription'];
    }
}
