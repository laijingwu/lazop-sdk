<?php

namespace Lazada\OpenPlatform\Request\Order;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Order\GetMultipleOrderItemsResponse;

class GetMultipleOrderItemsRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::ORDER_GET_MULTIPLE_ORDER_ITEMS_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'GET';
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validate('orderIds');

        $data = $this->mergeData($data, [
            'order_ids' => $this->arrayToString($this->getOrderIds(), 'int')
        ]);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new GetMultipleOrderItemsResponse($this, parent::sendData($data));
    }

    public function getOrderIds()
    {
        return $this->getParameter("orderIds", []);
    }

    public function setOrderIds(array $values)
    {
        return $this->setParameter("orderIds", $values);
    }

    public function addOrderId($value)
    {
        $values = $this->getOrderIds();
        array_push($values, $value);
        return $this->setParameter("orderIds", $values);
    }
}
