<?php

namespace Lazada\OpenPlatform\Payload;

use DOMDocument;

class UpdateProductPayload extends AbstractPayload
{
    protected $primaryCategory;

    protected $spuId;

    protected $attributes = [];

    protected $skus = [];

    protected $isFilter = false;

    public function setPrimaryCategory($id)
    {
        $this->primaryCategory = $id;
    }

    public function setSpuId($id)
    {
        $this->spuId = $id;
    }

    public function addAttr($key, $value)
    {
        $this->attributes[$key] = $value;
        $this->isFilter = false;
    }

    public function addSku(
        $sellerSku,
        $status,
        $quantity,
        $price,
        $specialPrice,
        \DateTime $specialFromDate,
        \DateTime $specialToDate,
        $packageLength,
        $packageWidth,
        $packageHeight,
        $packageWeight,
        $packageContent,
        array $images = null)
    {
        $sku = [
            'SellerSku' => $sellerSku,
            'Status' => $status,
            'price' => $price,
            'quantity' => $quantity,
            'special_price' => $specialPrice,
            'special_from_date' => $specialFromDate ? $specialFromDate->format('Y-m-d H:i') : null,
            'special_to_date' => $specialToDate ? $specialToDate->format('Y-m-d H:i') : null,
            'package_height' => $packageHeight,
            'package_length' => $packageLength,
            'package_width' => $packageWidth,
            'package_weight' => $packageWeight,
            'package_content' => $packageContent,
            'Images' => $images
        ];

        array_push($this->skus, $sku);
        $this->isFilter = false;
    }

    public function validate()
    {
        $skus = $this->skus;

        foreach ($skus as $k => $sku) {
            $sku = $this->filter($sku, false, ['Images']);
            if (isset($sku['Images']) && is_null($sku['Images'])) {
                unset($sku['Images']);
            }

            $this->validateAll($sku, 'SellerSku');
            $this->validateOne($sku,
                'Status', 'price', 'quantity', 'special_price', 'special_from_date', 'special_to_date',
                'package_height', 'package_length', 'package_width', 'package_weight', 'package_content', 'Images'
            );

            if (isset($sku['special_price'])) {
                $this->validateOne($sku, 'special_from_date', 'special_to_date');
            } elseif (isset($skus['special_from_date']) || isset($sku['special_to_date'])) {
                $this->validateAll($sku, 'special_price');
            }

            $skus[$k] = $sku;
        }

        $this->skus = $skus;
        unset($skus);

        $this->attributes = $this->filter($this->attributes);
        $this->isFilter = true;
    }

    public function pack()
    {
        $_skus = $this->skus;
        $_attrs = $this->attributes;
        if (!$this->isFilter) {
            $_skus = $this->filter($_skus, false, ['Images']);
            if (isset($_skus['Images']) && is_null($_skus['Images'])) {
                unset($_skus['Images']);
            }

            $_attrs = $this->filter($_attrs);
        }

        $dom = new DOMDocument('1.0', 'UTF-8');

        $request = $dom->createElement('Request');
        $dom->appendChild($request);

        $product = $dom->createElement('Product');
        $request->appendChild($product);

        if (!empty($this->primaryCategory)) {
            $product->appendChild($dom->createElement('PrimaryCategory', $this->primaryCategory));
        }

        if (!empty($this->spuId)) {
            $product->appendChild($dom->createElement('SPUId', $this->spuId));
        }

        $attributes = $dom->createElement('Attributes');
        $product->appendChild($attributes);

        foreach ($_attrs as $k => $v) {
            $v = $dom->createElement($k);

            // HTML
            if ($v != strip_tags($v)) {
                $v->appendChild($dom->createCDATASection($v));
            }

            $attributes->appendChild($v);
        }
        unset($_attrs);

        $skus = $dom->createElement('Skus');
        $product->appendChild($skus);

        foreach ($_skus as $_sku) {
            $sku = $dom->createElement('Sku');
            foreach ($_sku as $k => $v) {
                if ($k == 'Images') {
                    $kv = $this->packArray($dom, $k, 'Image', $v);
                } else {
                    $kv = $dom->createElement($k, $v);
                }
                $sku->appendChild($kv);
            }
            $skus->appendChild($sku);
        }
        unset($_skus);

        return $dom->saveXML();
    }

    public function clear()
    {
        $this->attributes = $this->skus = [];
    }

    protected function packArray(DOMDocument &$dom, $nodeName, $childNodeName, array $arrays)
    {
        $node = $dom->createElement($nodeName);
        foreach ($arrays as $item) {
            $childNode = $dom->createElement($childNodeName, $item);
            $node->appendChild($childNode);
        }
        return $node;
    }
}
