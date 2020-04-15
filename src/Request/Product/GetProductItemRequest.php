<?php

namespace Lazada\OpenPlatform\Request\Product;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Product\GetProductItemResponse;

class GetProductItemRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::PRODUCT_GET_PRODUCT_ITEM_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'GET';
    }

    public function getData()
    {
        $data = parent::getData();

        $data = $this->mergeData($data, [
            'item_id' => $this->getItemId(),
            'seller_sku' => $this->getSellerSku()
        ]);

        $data = $this->filterData($data);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new GetProductItemResponse($this, parent::sendData($data));
    }

    public function getItemId()
    {
        return $this->getParameter('itemId');
    }

    public function setItemId($value)
    {
        return $this->setParameter('itemId', $value);
    }

    public function getSellerSku()
    {
        return $this->getParameter('sellerSku');
    }

    public function setSellerSku($value)
    {
        return $this->setParameter('sellerSku', $value);
    }
}
