<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class SetStatusToRTSResponse extends AbstractLazopResponse
{
    public function getOrderItems()
    {
        return $this->data['data']['order_items'] ?? [];
    }
}
