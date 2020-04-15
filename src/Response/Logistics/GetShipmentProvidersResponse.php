<?php

namespace Lazada\OpenPlatform\Response\Logistics;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetShipmentProvidersResponse extends AbstractLazopResponse
{
    public function getProviders()
    {
        return $this->data['data']['shipment_providers'] ?? [];
    }
}
