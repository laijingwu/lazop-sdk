<?php

namespace Lazada\OpenPlatform\Request\Order;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Order\SetStatusToCanceledResponse;

class SetStatusToCanceledRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::ORDER_SET_STATUS_TO_CANCELED_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'POST';
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validate('reasonId', 'orderItemId');

        $data = $this->mergeData($data, [
            'reason_id' => $this->getReasonId(),
            'order_item_id' => $this->getOrderItemId(),
            'reason_detail' => $this->getReasonDetail()
        ]);

        $data = $this->filterData($data);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new SetStatusToCanceledResponse($this, parent::sendData($data));
    }

    public function getOrderItemId()
    {
        return $this->getParameter('orderItemId');
    }

    public function setOrderItemId($value)
    {
        return $this->setParameter('orderItemId', $value);
    }

    public function getReasonId()
    {
        return $this->getParameter('reasonId');
    }

    public function setReasonId($value)
    {
        return $this->setParameter('reasonId', $value);
    }

    public function getReasonDetail()
    {
        return $this->getParameter('reasonDetail');
    }

    public function setReasonDetail($value)
    {
        return $this->setParameter('reasonDetail', $value);
    }
}
