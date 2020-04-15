<?php

namespace Lazada\OpenPlatform\Request\Order;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Order\GetOrdersResponse;

class GetOrdersRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::ORDER_GET_ORDERS_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'GET';
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validateOne('createdAfter', 'updatedAfter');

        $data = $this->mergeData($data, [
            'created_after' => $this->getCreatedAfter(),
            'created_before' => $this->getCreatedBefore(),
            'update_after' => $this->getUpdatedAfter(),
            'update_before' => $this->getUpdatedBefore(),
            'status' => $this->getStatus(),
            'sort_direction' => $this->getSort(),
            'sort_by' => $this->getSortBy(),
            'offset' => $this->getOffset(),
            'limit' => $this->getLimit()
        ]);

        $data = $this->filterData($data);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new GetOrdersResponse($this, parent::sendData($data));
    }

    public function getCreatedPeriod()
    {
        return [$this->getCreatedAfter(), $this->getCreatedBefore()];
    }

    public function setCreatedPeriod(\DateTime $begin, \DateTime $end = null)
    {
        $this->setCreatedAfter($begin);
        if ($end) {
            $this->setCreatedBefore($end);
        }
        return $this;
    }

    public function getCreatedAfter()
    {
        return $this->getParameter('createdAfter');
    }

    public function getCreatedBefore()
    {
        return $this->getParameter('createdBefore');
    }

    public function setCreatedAfter(\DateTime $time)
    {
        return $this->setParameter("createdAfter", $time->format(DATE_ISO8601));
    }

    public function setCreatedBefore(\DateTime $time)
    {
        return $this->setParameter("createdBefore", $time->format(DATE_ISO8601));
    }

    public function getStatus()
    {
        return $this->getParameter('status');
    }

    public function setStatus($value)
    {
        return $this->setParameter('status', $value);
    }

    public function getUpdatedPeriod()
    {
        return [$this->getUpdatedAfter(), $this->getUpdatedBefore()];
    }

    public function setUpdatedPeriod(\DateTime $begin, \DateTime $end = null)
    {
        $this->setUpdatedAfter($begin);
        if ($end) {
            $this->setUpdatedBefore($end);
        }
        return $this;
    }

    public function getUpdatedAfter()
    {
        return $this->getParameter('updatedAfter');
    }

    public function getUpdatedBefore()
    {
        return $this->getParameter('updatedBefore');
    }

    public function setUpdatedAfter(\DateTime $time)
    {
        return $this->setParameter("updatedAfter", $time->format(DATE_ISO8601));
    }

    public function setUpdatedBefore(\DateTime $time)
    {
        return $this->setParameter("updatedBefore", $time->format(DATE_ISO8601));
    }

    public function getSort()
    {
        return $this->getParameter('sortDirection');
    }

    public function setSort($value = 'ASC')
    {
        return $this->setParameter('sortDirection', $value);
    }

    public function setSortASC()
    {
        return $this->setParameter('sortDirection', 'ASC');
    }

    public function setSortDESC()
    {
        return $this->setParameter('sortDirection', 'DESC');
    }

    public function getOffset()
    {
        return $this->getParameter('offset');
    }

    public function setOffset(int $value)
    {
        return $this->setParameter('offset', $value);
    }

    public function getLimit()
    {
        return $this->getParameter('limit');
    }

    public function setLimit(int $value)
    {
        return $this->setParameter('limit', $value);
    }

    public function getSortBy()
    {
        return $this->getParameter('sortBy');
    }

    public function setSortBy($value)
    {
        return $this->setParameter('sortBy', $value);
    }
}
