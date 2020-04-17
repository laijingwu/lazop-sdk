<?php

namespace Lazada\OpenPlatform;

use Lazada\OpenPlatform\Common\AbstractClient;
use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Exception\RuntimeException;
use Lazada\OpenPlatform\Request\Authorization\GenerateAccessTokenRequest;
use Lazada\OpenPlatform\Request\Authorization\RedirectAuthorizeRequest;
use Lazada\OpenPlatform\Request\Authorization\RefreshAccessTokenRequest;
use Lazada\OpenPlatform\Request\DataMoat\ComputeRiskRequest;
use Lazada\OpenPlatform\Request\DataMoat\LoginRequest;
use Lazada\OpenPlatform\Request\Logistics\GetShipmentProvidersRequest;
use Lazada\OpenPlatform\Request\Order\GetDocumentRequest;
use Lazada\OpenPlatform\Request\Order\GetFailureReasonsRequest;
use Lazada\OpenPlatform\Request\Order\GetMultipleOrderItemsRequest;
use Lazada\OpenPlatform\Request\Order\GetOrderItemsRequest;
use Lazada\OpenPlatform\Request\Order\GetOrderRequest;
use Lazada\OpenPlatform\Request\Order\GetOrdersRequest;
use Lazada\OpenPlatform\Request\Order\SetInvoiceNumberRequest;
use Lazada\OpenPlatform\Request\Order\SetStatusToCanceledRequest;
use Lazada\OpenPlatform\Request\Order\SetStatusToPackedRequest;
use Lazada\OpenPlatform\Request\Order\SetStatusToRTSRequest;
use Lazada\OpenPlatform\Request\Product\GetProductItemRequest;
use Lazada\OpenPlatform\Request\Product\GetProductsRequest;
use Lazada\OpenPlatform\Request\Product\UpdatePriceQuantityRequest;
use Lazada\OpenPlatform\Request\Product\UpdateProductRequest;
use Lazada\OpenPlatform\Request\Seller\GetSellerRequest;

class Client extends AbstractClient
{
    public function getServiceLocale()
    {
        return $this->getParameter("apiHostKey");
    }

    public function setServiceLocale($locale)
    {
        if (LazopEndpoint::hasLocale($locale)) {
            $this->setParameter("serviceLocale", $locale);
        } else {
            throw new RuntimeException("The service locale which is {$locale} not found.");
        }
    }


    /** OAuth API **/

    public function authorize(array $parameters = array())
    {
        return $this->createRequest(RedirectAuthorizeRequest::class, $parameters);
    }

    public function generateAccessToken(array $parameters = array())
    {
        return $this->createRequest(GenerateAccessTokenRequest::class, $parameters);
    }

    public function refreshAccessToken(array $parameters = array())
    {
        return $this->createRequest(RefreshAccessTokenRequest::class, $parameters);
    }

    /** OAuth API END **/


    /** Order API **/

    public function getDocument(array $parameters = array())
    {
        return $this->createRequest(GetDocumentRequest::class, $parameters);
    }

    public function getFailureReasons(array $parameters = array())
    {
        return $this->createRequest(GetFailureReasonsRequest::class, $parameters);
    }

    public function getMultipleOrderItems(array $parameters = array())
    {
        return $this->createRequest(GetMultipleOrderItemsRequest::class, $parameters);
    }

    public function getOrderItems(array $parameters = array())
    {
        return $this->createRequest(GetOrderItemsRequest::class, $parameters);
    }

    public function getOrder(array $parameters = array())
    {
        return $this->createRequest(GetOrderRequest::class, $parameters);
    }

    public function getOrders(array $parameters = array())
    {
        return $this->createRequest(GetOrdersRequest::class, $parameters);
    }

    public function setInvoiceNumber(array $parameters = array())
    {
        return $this->createRequest(SetInvoiceNumberRequest::class, $parameters);
    }

    public function setStatusToCanceled(array $parameters = array())
    {
        return $this->createRequest(SetStatusToCanceledRequest::class, $parameters);
    }

    public function setStatusToPacked(array $parameters = array())
    {
        return $this->createRequest(SetStatusToPackedRequest::class, $parameters);
    }

    public function setStatusToRTS(array $parameters = array())
    {
        return $this->createRequest(SetStatusToRTSRequest::class, $parameters);
    }

    /** Order API END **/


    /** Product API **/

    public function getProductItem(array $parameters = array())
    {
        return $this->createRequest(GetProductItemRequest::class, $parameters);
    }

    public function getProducts(array $parameters = array())
    {
        return $this->createRequest(GetProductsRequest::class, $parameters);
    }

    public function updatePriceQuantity(array $parameters = array())
    {
        return $this->createRequest(UpdatePriceQuantityRequest::class, $parameters);
    }

    public function updateProduct(array $parameters = array())
    {
        return $this->createRequest(UpdateProductRequest::class, $parameters);
    }

    /** Product API END **/


    /** Logistics API **/

    public function getShipmentProviders(array $parameters = array())
    {
        return $this->createRequest(GetShipmentProvidersRequest::class, $parameters);
    }

    /** Logistics API END **/


    /** Seller API **/

    public function getSeller(array $parameters = array())
    {
        return $this->createRequest(GetSellerRequest::class, $parameters);
    }

    /** Seller API END **/


    /** DataMoat API **/

    public function computeRisk(array $parameters = array())
    {
        return $this->createRequest(ComputeRiskRequest::class, $parameters);
    }

    public function login(array $parameters = array())
    {
        return $this->createRequest(LoginRequest::class, $parameters);
    }

    /** DataMoat API END **/
}
