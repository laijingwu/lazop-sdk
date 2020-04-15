<?php

namespace Lazada\OpenPlatform\Request\Product;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Request\AbstractLazopRequest;
use Lazada\OpenPlatform\Response\Product\GetProductsResponse;

class GetProductsRequest extends AbstractLazopRequest
{
    protected $apiEndpointUri = LazopEndpoint::PRODUCT_GET_PRODUCTS_URI;

    protected $requireAuthorization = true;

    public function getRequestMethod()
    {
        return 'GET';
    }

    public function getData()
    {
        $data = parent::getData();

        $this->validate('filter');

        $data = $this->mergeData($data, [
            'filter' => $this->getFilter(),
            'created_after' => $this->getCreatedAfter(),
            'created_before' => $this->getCreatedBefore(),
            'update_after' => $this->getUpdatedAfter(),
            'update_before' => $this->getUpdatedBefore(),
            'search' => $this->getSearch(),
            'offset' => $this->getOffset(),
            'limit' => $this->getLimit(),
            'options' => $this->getOptions(),
            'sku_seller_list' => $this->arrayToString($this->getSkuSellerList())
        ]);

        $data = $this->filterData($data);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new GetProductsResponse($this, parent::sendData($data));
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

    public function getFilter()
    {
        return $this->getParameter('filter');
    }

    public function setFilter($value)
    {
        return $this->setParameter('filter', $value);
    }


    public function getSearch()
    {
        return $this->getParameter('search');
    }

    public function setSearch($value)
    {
        return $this->setParameter('search', $value);
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

    public function getOptions()
    {
        return $this->getParameter('options');
    }

    public function setOptions($value)
    {
        return $this->setParameter('options', $value);
    }

    public function getSkuSellerList()
    {
        return $this->getParameter('skuSellerList', []);
    }

    public function setSkuSellerList(array $values)
    {
        return $this->setParameter('skuSellerList', $values);
    }
}
