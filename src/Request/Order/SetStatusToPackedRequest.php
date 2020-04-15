<?php

namespace Lazada\OpenPlatform\Request\Order;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Common\LazopReference;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Order\SetStatusToPackedResponse;

class SetStatusToPackedRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::ORDER_SET_STATUS_TO_PACKED_BY_MARKETPLACE_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'POST';
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validate('deliveryType', 'orderItemIds');

        $data = $this->mergeData($data, [
            'shipping_provider' => $this->getShippingProvider(),
            'delivery_type' => $this->getDeliveryType(),
            'order_item_ids' => $this->arrayToString($this->getOrderItemIds())
        ]);

        if ($data['delivery_type'] == LazopReference::DELIVERY_TYPE_DROPSHIP) {
            $this->validate('shippingProvider');
        }

        $data = $this->filterData($data);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new SetStatusToPackedResponse($this, parent::sendData($data));
    }

    public function getShippingProvider()
    {
        return $this->getParameter('shippingProvider');
    }

    public function setShippingProvider($value)
    {
        return $this->setParameter('shippingProvider', $value);
    }

    public function getDeliveryType()
    {
        return $this->getParameter('deliveryType');
    }

    public function setDeliveryType($value)
    {
        return $this->setParameter('deliveryType', $value);
    }

    public function getOrderItemIds()
    {
        return $this->getParameter("orderItemIds", []);
    }

    public function setOrderItemIds(array $values)
    {
        return $this->setParameter("orderItemIds", $values);
    }

    public function addOrderItemId($value)
    {
        $values = $this->getOrderItemIds();
        array_push($values, $value);
        return $this->setParameter("orderItemIds", $values);
    }
}
