<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetOrdersResponse extends AbstractLazopResponse
{
    public function getOrders()
    {
        return $this->data['data']['orders'] ?? [];
    }

    public function getCount()
    {
        return intval($this->data['data']['count'] ?? 0);
    }
}
