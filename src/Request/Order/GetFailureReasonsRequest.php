<?php

namespace Lazada\OpenPlatform\Request\Order;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Order\GetFailureReasonsResponse;

class GetFailureReasonsRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::ORDER_GET_FAILURE_REASONS_URI;

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
        return $this->response = new GetFailureReasonsResponse($this, parent::sendData($data));
    }
}
