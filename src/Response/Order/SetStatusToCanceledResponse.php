<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class SetStatusToCanceledResponse extends AbstractLazopResponse
{
    public function isSuccessful()
    {
        return parent::isSuccessful() && $this->data['success'] == "true";
    }
}
