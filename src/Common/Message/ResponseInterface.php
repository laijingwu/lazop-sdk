<?php

namespace Lazada\OpenPlatform\Common\Message;

interface ResponseInterface extends MessageInterface
{
    public function getRequest();

    public function isSuccessful();

    public function isRedirect();

    public function getMessage();

    public function getCode();
}
