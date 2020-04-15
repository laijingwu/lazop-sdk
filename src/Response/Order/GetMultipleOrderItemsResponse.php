<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetMultipleOrderItemsResponse extends AbstractLazopResponse
{
    public function getOrders()
    {
        return $this->data['data'] ?? [];
    }
}
