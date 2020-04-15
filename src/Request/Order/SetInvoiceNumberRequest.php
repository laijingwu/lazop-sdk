<?php

namespace Lazada\OpenPlatform\Request\Order;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Order\SetInvoiceNumberResponse;

class SetInvoiceNumberRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::ORDER_SET_INVOICE_NUMBER_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'POST';
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validate('orderItemId', 'invoiceNumber');

        $data = $this->mergeData($data, [
            'order_item_id' => $this->getOrderItemId(),
            'invoice_number' => $this->getInvoiceNo()
        ]);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new SetInvoiceNumberResponse($this, parent::sendData($data));
    }

    public function getOrderItemId()
    {
        return $this->getParameter('orderItemId');
    }

    public function setOrderItemId($value)
    {
        return $this->setParameter('orderItemId', $value);
    }

    public function getInvoiceNo()
    {
        return $this->getParameter('invoiceNumber');
    }

    public function setInvoiceNo($value)
    {
        return $this->setParameter('invoiceNumber', $value);
    }
}
