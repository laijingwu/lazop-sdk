<?php

namespace Lazada\OpenPlatform\Request\Order;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Common\LazopReference;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Order\SetStatusToRTSResponse;

class SetStatusToRTSRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::ORDER_SET_STATUS_TO_RTS_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'POST';
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validate(
            'shipmentProvider',
//            'deliveryType',
            'orderItemIds',
            'trackingNumber'
        );

        $data = $this->mergeData($data, [
            'delivery_type' => $this->getDeliveryType() ?: LazopReference::DELIVERY_TYPE_DROPSHIP,
            'order_item_ids' => $this->arrayToString($this->getOrderItemIds()),
            'shipment_provider' => $this->getShipmentProvider(),
            'tracking_number' => $this->getTrackingNo()
        ]);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new SetStatusToRTSResponse($this, parent::sendData($data));
    }

    public function getShipmentProvider()
    {
        return $this->getParameter('shipmentProvider');
    }

    public function setShipmentProvider($value)
    {
        return $this->setParameter('shipmentProvider', $value);
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

    public function getTrackingNo()
    {
        return $this->getParameter('trackingNumber');
    }

    public function setTrackingNo($value)
    {
        return $this->setParameter('trackingNumber', $value);
    }
}
