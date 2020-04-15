<?php

namespace Lazada\OpenPlatform\Request\Seller;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Seller\GetSellerResponse;

class GetSellerRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::SELLER_GET_SELLER_URI;

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
        return $this->response = new GetSellerResponse($this, parent::sendData($data));
    }
}
