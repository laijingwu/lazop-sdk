<?php

namespace Lazada\OpenPlatform\Response\Order;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetDocumentResponse extends AbstractLazopResponse
{
    public function getDocument()
    {
        return $this->data['data']['document'] ?? null;
    }
}
