<?php

namespace Lazada\OpenPlatform\Request\Product;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Payload\PayloadRequestTrait;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Product\UpdatePriceQuantityResponse;

class UpdatePriceQuantityRequest extends AbstractLazopRequest
{
    use PayloadRequestTrait;

    protected $apiEndpointUri = LazopEndpoint::PRODUCT_UPDATE_PRICE_QUANTITY_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        return $this->response = new UpdatePriceQuantityResponse($this, parent::sendData($data));
    }
}
