<?php

namespace Lazada\OpenPlatform\Request\Logistics;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Logistics\GetShipmentProvidersResponse;

class GetShipmentProvidersRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::LOGISTICS_GET_SHIPMENT_PROVIDERS_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'GET';
    }

    public function getData()
    {
        $data = parent::getData();

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new GetShipmentProvidersResponse($this, parent::sendData($data));
    }
}
