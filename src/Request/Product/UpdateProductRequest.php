<?php

namespace Lazada\OpenPlatform\Request\Product;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Payload\PayloadRequestTrait;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Product\UpdateProductResponse;

class UpdateProductRequest extends AbstractLazopRequest
{
    use PayloadRequestTrait;

    protected $apiEndpointUri = LazopEndpoint::PRODUCT_UPDATE_PRODUCT_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        return $this->response = new UpdateProductResponse($this, parent::sendData($data));
    }
}
