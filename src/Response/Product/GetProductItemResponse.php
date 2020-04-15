<?php

namespace Lazada\OpenPlatform\Response\Product;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetProductItemResponse extends AbstractLazopResponse
{
    public function getSkus()
    {
        return $this->data['data']['skus'] ?? [];
    }

    public function getItemId()
    {
        return $this->data['data']['item_id'];
    }

    public function getPrimaryCategory()
    {
        return $this->data['data']['primary_category'];
    }

    public function getAttributes()
    {
        return $this->data['data']['attributes'] ?? [];
    }
}
