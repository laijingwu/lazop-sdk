<?php

namespace Lazada\OpenPlatform\Response\Authorization;

use Lazada\OpenPlatform\Response\AbstractLazopResponse;

class RefreshAccessTokenResponse extends AbstractLazopResponse
{
    public function getCountry()
    {
        return $this->data['country'];
    }

    public function getAccessToken()
    {
        return $this->data['access_token'];
    }

    public function getAccessTokenExpiresIn()
    {
        return $this->data['expires_in'];
    }

    public function getRefreshToken()
    {
        return $this->data['refresh_token'];
    }

    public function getRefreshTokenExpiresIn()
    {
        return $this->data['refresh_expires_in'];
    }

    public function getAccount()
    {
        return $this->data['account'];
    }

    public function getAccountPlatform()
    {
        return $this->data['account_platform'];
    }
}
