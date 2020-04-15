<?php

namespace Lazada\OpenPlatform\Request\Order;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Order\GetOrderResponse;

class GetOrderRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::ORDER_GET_ORDER_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'GET';
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validate('orderId');

        $data = $this->mergeData($data, [
            'order_id' => $this->getOrderId()
        ]);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new GetOrderResponse($this, parent::sendData($data));
    }

    public function getOrderId()
    {
        return $this->getParameter("orderId");
    }

    public function setOrderId($values)
    {
        return $this->setParameter("orderId", $values);
    }
}
