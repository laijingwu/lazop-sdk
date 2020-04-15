<?php

namespace Lazada\OpenPlatform\Common\Message;

use Omnipay\Common\Message\ResponseInterface;

interface RequestInterface extends MessageInterface
{
    public function initialize(array $parameters = array());

    public function getParameters();

    public function getResponse();

    public function send();

    public function sendData($data);
}
