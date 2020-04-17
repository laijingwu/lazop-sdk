<?php

namespace Lazada\OpenPlatform\Laravel;

use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Facade;

/**
 * Class LazopFacade
 * @package Lazada\OpenPlatform\Laravel
 *
 * @method static initialize(array $parameters = array())
 * @method static getDefaultParameters()
 * @method static getParameters()
 * @method static getParameter($key, $default = false)
 * @method static setParameter($key, $value)
 * @method static getTestMode()
 * @method static setTestMode($value)
 * @method static production()
 * @method static sandbox()
 * @method static getAppId()
 * @method static setAppId($appid)
 * @method static getAppSecret()
 * @method static setAppSecret($secret)
 * @method static getAppName()
 * @method static setAppName($appname)
 * @method static setHttpClient(ClientInterface $client)
 *
 * @method static getServiceLocale()
 * @method static setServiceLocale($locale)
 *
 * @method static authorize(array $parameters = array())
 * @method static generateAccessToken(array $parameters = array())
 * @method static refreshAccessToken(array $parameters = array())
 * @method static getDocument(array $parameters = array())
 * @method static getFailureReasons(array $parameters = array())
 * @method static getMultipleOrderItems(array $parameters = array())
 * @method static getOrderItems(array $parameters = array())
 * @method static getOrder(array $parameters = array())
 * @method static getOrders(array $parameters = array())
 * @method static setInvoiceNumber(array $parameters = array())
 * @method static setStatusToCanceled(array $parameters = array())
 * @method static setStatusToPacked(array $parameters = array())
 * @method static setStatusToRTS(array $parameters = array())
 * @method static getProductItem(array $parameters = array())
 * @method static getProducts(array $parameters = array())
 * @method static updatePriceQuantity(array $parameters = array())
 * @method static updateProduct(array $parameters = array())
 * @method static getShipmentProviders(array $parameters = array())
 */
class LazopFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lazop-client';
    }
}
