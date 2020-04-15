<?php

namespace Lazada\OpenPlatform\Common\Message;

interface RedirectResponseInterface extends ResponseInterface
{
    public function getRedirectUrl();

    public function getRedirectMethod();

    public function getRedirectData();
}
