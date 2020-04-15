<?php

namespace Lazada\OpenPlatform\Response\Seller;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class GetSellerResponse extends AbstractLazopResponse
{
    public function getName()
    {
        return $this->data['data']['name'];
    }

    public function getCompanyName()
    {
        return $this->data['data']['name_company'];
    }

    public function getLogo()
    {
        return $this->data['data']['logo_url'];
    }

    public function getSellerId()
    {
        return $this->data['data']['seller_id'];
    }

    public function getEmail()
    {
        return $this->data['data']['email'];
    }

    public function getLocation()
    {
        return $this->data['data']['location'];
    }

    public function isCrossBorder()
    {
        return boolval($this->data['data']['cb'] ?? false);
    }
}
