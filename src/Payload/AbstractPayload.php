<?php

namespace Lazada\OpenPlatform\Payload;

use DOMDocument;
use Lazada\OpenPlatform\Common\Helper;
use Lazada\OpenPlatform\Exception\InvalidRequestException;

abstract class AbstractPayload implements PayloadInterface
{
    protected function validateAll($data, ...$args)
    {
        foreach ($args as $key) {
            if (!isset($data[$key])) {
                throw new InvalidRequestException("The $key parameter is required");
            }
        }
    }

    protected function validateOne($data, ...$args)
    {
        $ok = false;
        foreach ($args as $key) {
            if (isset($data[$key])) {
                $ok = true;
            }
        }

        if (!$ok) {
            throw new InvalidRequestException("Nothing parameter, require a parameter in " . implode(", ", $args) . " fields at least");
        }
    }

    protected function filter(array $data, $studlyKey = false, array $exceptKeys = [])
    {
        foreach ($data as $k => $v) {
            if (in_array($k, $exceptKeys)) {
                continue;
            }

            if (is_array($v)) {
                $v = $this->filter($v, $studlyKey);
            }

            if (is_array($v) && count($v) == 0) {
                unset($data[$k]);
            } elseif (is_null($v) || $v === '') {
                unset($data[$k]);
            } elseif ($studlyKey) {
                unset($data[$k]);
                $data[Helper::studly($k)] = $v;
            }
        }

        return $data;
    }

    protected function packArray(DOMDocument &$dom, $nodeName, $childNodeName, array $arrays)
    {
        $node = $dom->createElement($nodeName);
        foreach ($arrays as $array) {
            $childNode = $dom->createElement($childNodeName);
            foreach ($array as $k => $v) {
                $kv = $dom->createElement($k, $v);
                $childNode->appendChild($kv);
            }
            $node->appendChild($childNode);
        }
        return $node;
    }

    public function __toString()
    {
        return $this->pack();
    }
}
