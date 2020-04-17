<?php

namespace Lazada\OpenPlatform\Common;

class LazopReference
{
    const
        DOCTYPE_INVOICE = 'invoice',
        DOCTYPE_SHIPPING_LABEL = 'shippingLabel',
        DOCTYPE_CARRIER_MANIFEST = 'carrierManifest',

        SORT_DESC = 'DESC',
        SORT_ASC = 'ASC',
        SORT_BY_CREATED_AT = 'created_at',
        SORT_BY_UPDATED_AT = 'updated_at',

        ORDER_STATUS_UNPAID = 'unpaid',
        ORDER_STATUS_PENDING = 'pending',
        ORDER_STATUS_CANCELED = 'canceled',
        ORDER_STATUS_RTS = 'ready_to_ship',
        ORDER_STATUS_DELIVERED = 'delivered',
        ORDER_STATUS_RETURNED = 'returned',
        ORDER_STATUS_SHIPPED = 'shipped',
        ORDER_STATUS_FAILED = 'failed',

        DELIVERY_TYPE_DROPSHIP = 'dropship',
        DELIVERY_TYPE_PICKUP = 'pickup',
        DELIVERY_TYPE_STW = 'send_to_warehouse',

        PRODUCT_STATUS_ACTIVE = 'active',
        PRODUCT_STATUS_INACTIVE = 'inactive',
        PRODUCT_STATUS_DELETED = 'deleted',

        PRODUCT_FILTER_ALL = 'all',
        PRODUCT_FILTER_LIVE = 'live',
        PRODUCT_FILTER_INACTIVE = 'inactive',
        PRODUCT_FILTER_DELETED = 'deleted',
        PRODUCT_FILTER_IMAGE_MISSING = 'image-missing',
        PRODUCT_FILTER_PENDING = 'pending',
        PRODUCT_FILTER_REJECTED = 'rejected',
        PRODUCT_FILTER_SOLD_OUT = 'sold-out',

        LOGIN_SUCCESS = 'success',
        LOGIN_FAILED = 'fail'
    ;
}
