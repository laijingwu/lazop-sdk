<?php

namespace Lazada\OpenPlatform\Response\Authorization;

use Lazada\OpenPlatform\Common\LazopEndpoint;
use Lazada\OpenPlatform\Common\Message\AbstractResponse;
use Lazada\OpenPlatform\Common\Message\RedirectResponseInterface;

class RedirectAuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }

    public function getRedirectUrl()
    {
        return LazopEndpoint::OAUTH_AUTHORIZE_ENDPOINT . "?" . http_build_query($this->getRedirectData());
    }
}
