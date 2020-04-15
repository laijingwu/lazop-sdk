<?php

namespace Lazada\OpenPlatform\Payload;

interface PayloadInterface
{
    public function validate();

    public function pack();

    public function clear();
}
