<?php

namespace Lazada\OpenPlatform\Request\Order;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Order\GetDocumentResponse;

class GetDocumentRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::ORDER_GET_DOCUMENT_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'GET';
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validate('docType', 'orderItemIds');

        $data = $this->mergeData($data, [
            'doc_type' => $this->getDocType(),
            'order_item_ids' => $this->arrayToString($this->getOrderItemIds(), 'int')
        ]);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new GetDocumentResponse($this, parent::sendData($data));
    }

    public function getDocType()
    {
        return $this->getParameter("docType");
    }

    public function setDocType($value)
    {
        return $this->setParameter("docType", $value);
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
