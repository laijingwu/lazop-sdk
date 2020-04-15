<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class SetStatusToPackedResponse extends AbstractLazopResponse
{
    public function getOrderItems()
    {
        return $this->data['data']['order_items'] ?? [];
    }
}
