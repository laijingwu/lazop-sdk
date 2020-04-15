<?php

namespace Lazada\OpenPlatform\Common\Message;

use Lazada\OpenPlatform\Exception\RuntimeException;

abstract class AbstractResponse implements ResponseInterface
{
    protected $request;

    protected $data;

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function isRedirect()
    {
        return false;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getMessage()
    {
        return null;
    }

    public function getCode()
    {
        return null;
    }

    public function getRedirectUrl()
    {
        return null;
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return [];
    }

    protected function validateRedirect()
    {
        if (!$this instanceof RedirectResponseInterface || !$this->isRedirect()) {
            throw new RuntimeException('This response does not support redirection.');
        }

        if (empty($this->getRedirectUrl())) {
            throw new RuntimeException('The given redirectUrl cannot be empty.');
        }

        if (!in_array($this->getRedirectMethod(), ['GET', 'POST'])) {
            throw new RuntimeException('Invalid redirect method "'.$this->getRedirectMethod().'".');
        }
    }

    public function getRedirectResponse()
    {
        $this->validateRedirect();

        if ('GET' === $this->getRedirectMethod()) {
            return $this->getRedirectUrl();
        }

        $hiddenFields = '';
        foreach ($this->getRedirectData() as $key => $value) {
            $hiddenFields .= sprintf(
                    '<input type="hidden" name="%1$s" value="%2$s" />',
                    htmlentities($key, ENT_QUOTES, 'UTF-8', false),
                    htmlentities($value, ENT_QUOTES, 'UTF-8', false)
                )."\n";
        }

        $output = '<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Redirecting...</title>
</head>
<body onload="document.forms[0].submit();">
    <form action="%1$s" method="post">
        <p>Redirecting to payment page...</p>
        <p>
            %2$s
            <input type="submit" value="Continue" />
        </p>
    </form>
</body>
</html>';
        $output = sprintf(
            $output,
            htmlentities($this->getRedirectUrl(), ENT_QUOTES, 'UTF-8', false),
            $hiddenFields
        );

        return $output;
    }
}
