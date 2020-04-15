<?php

namespace Lazada\OpenPlatform\Response\Product;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetProductsResponse extends AbstractLazopResponse
{
    public function getProducts()
    {
        return $this->data['data']['products'] ?? [];
    }

    public function getCount()
    {
        return intval($this->data['data']['total_products'] ?? 0);
    }
}
