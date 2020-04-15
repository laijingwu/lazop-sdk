<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class SetInvoiceNumberResponse extends AbstractLazopResponse
{
    public function getOrderItemId()
    {
        return $this->data['data']['order_item_id'] ?? '';
    }

    public function getInvoiceNo()
    {
        return intval($this->data['data']['invoice_number'] ?? '');
    }
}
