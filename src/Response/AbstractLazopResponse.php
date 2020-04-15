<?php

namespace Lazada\OpenPlatform\Response;

use Lazada\OpenPlatform\Common\Message\AbstractResponse;

class AbstractLazopResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->data['code'] == 0;
    }

    public function getCode()
    {
        return $this->data['code'];
    }

    public function getMessage()
    {
        return $this->isSuccessful() ? 'ok' : $this->data['message'];
    }

    public function getRequestId()
    {
        return $this->data['request_id'];
    }
}
