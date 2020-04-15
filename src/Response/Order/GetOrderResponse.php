<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetOrderResponse extends AbstractLazopResponse
{
    public function getOrder()
    {
        return $this->data['data'] ?? null;
    }
}
