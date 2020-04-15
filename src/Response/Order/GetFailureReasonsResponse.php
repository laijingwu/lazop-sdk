<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetFailureReasonsResponse extends AbstractLazopResponse
{
    public function getReasons()
    {
        return $this->data['data'] ?? [];
    }
}
