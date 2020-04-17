<?php

namespace Lazada\OpenPlatform\Common;

class LazopEndpoint
{
    const API_HOSTS = [
        'sg' => 'https://api.lazada.sg', // Singapore
        'th' => 'https://api.lazada.co.th', // Thailand
        'my' => 'https://api.lazada.com.my', // Malaysia
        'vn' => 'https://api.lazada.vn', // Vietnam
        'ph' => 'https://api.lazada.com.ph', // Philippines
        'id' => 'https://api.lazada.co.id', // Indonesia
        'oauth' => 'https://auth.lazada.com',
        'common' => 'https://api.lazada.com'
    ];

    const
        OAUTH_AUTHORIZE_ENDPOINT = self::API_HOSTS['oauth'] . '/oauth/authorize',
        SYSTEM_GENERATE_ACCESS_TOKEN_URI = '/auth/token/create',
        SYSTEM_REFRESH_ACCESS_TOKEN_URI = '/auth/token/refresh',

        ORDER_GET_DOCUMENT_URI = '/order/document/get',
        ORDER_GET_FAILURE_REASONS_URI = '/order/failure_reason/get',
        ORDER_GET_MULTIPLE_ORDER_ITEMS_URI = '/orders/items/get',
        ORDER_GET_ORDER_URI = '/order/get',
        ORDER_GET_ORDER_ITEMS_URI = '/order/items/get',
        ORDER_GET_ORDERS_URI = '/orders/get',
        ORDER_SET_INVOICE_NUMBER_URI = '/order/invoice_number/set',
        ORDER_SET_STATUS_TO_CANCELED_URI = '/order/cancel',
        ORDER_SET_STATUS_TO_PACKED_BY_MARKETPLACE_URI = '/order/pack',
        ORDER_SET_STATUS_TO_RTS_URI = '/order/rts',

        PRODUCT_CREATE_PRODUCT_URI = '/product/create',
        PRODUCT_GET_BRANDS_URI = '/brands/get',
        PRODUCT_GET_CATEGORY_ATTRS_URI = '/category/attributes/get',
        PRODUCT_GET_CATEGORY_SUGGESTION_URI = '/product/category/suggestion/get',
        PRODUCT_GET_CATEGORY_TREE_URI = '/category/tree/get',
        PRODUCT_GET_PRODUCT_ITEM_URI = '/product/item/get',
        PRODUCT_GET_PRODUCTS_URI = '/products/get',
        PRODUCT_GET_QC_STATUS_URI = '/product/qc/status/get',
        PRODUCT_GET_RESPONSE_URI = '/image/response/get',
        PRODUCT_MIGRATE_IMAGE_URI = '/image/migrate',
        PRODUCT_MIGRATE_IMAGES_URI = '/images/migrate',
        PRODUCT_REMOVE_PRODUCT_URI = '/product/remove',
        PRODUCT_SET_IMAGES_URI = '/images/set',
        PRODUCT_UPDATE_PRICE_QUANTITY_URI = '/product/price_quantity/update',
        PRODUCT_UPDATE_PRODUCT_URI = '/product/update',

        LOGISTICS_GET_SHIPMENT_PROVIDERS_URI = '/shipment/providers/get',

        SELLER_GET_SELLER_URI = '/seller/get',

        DATA_MOAT_COMPUTE_RISK_URI = '/datamoat/compute_risk',
        DATA_MOAT_LOGIN_URI = '/datamoat/login'
    ;

    public static function hasLocale($locale)
    {
        return isset(self::API_HOSTS[$locale]);
    }

    public static function apiEndpoint($locale = 'my', $uri = '')
    {
        if (self::hasLocale($locale)) {
            return self::API_HOSTS[$locale] . '/rest' . $uri;
        }

        return null;
    }
}
