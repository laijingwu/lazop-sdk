<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetOrderItemsResponse extends AbstractLazopResponse
{
    public function getOrderItems()
    {
        return $this->data['data'] ?? [];
    }
}
