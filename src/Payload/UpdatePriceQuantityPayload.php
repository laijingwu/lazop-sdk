<?php

namespace Lazada\OpenPlatform\Payload;

use DOMDocument;

class UpdatePriceQuantityPayload extends AbstractPayload
{
    protected $skus = [];

    protected $isFilter = false;

    public function addSku($sellerSku, $price = null, $salePrice = null, \DateTime $saleStartDate = null, \DateTime $saleEndDate = null, $quantity = null, array $multiWarehouseInventories = [])
    {
        $sku = [
            'SellerSku' => $sellerSku,
            'Price' => $price,
            'SalePrice' => $salePrice,
            'SaleStartDate' => $saleStartDate ? $saleStartDate->format('Y-m-d H:i') : null,
            'SaleEndDate' => $saleEndDate ? $saleEndDate->format('Y-m-d H:i') : null
        ];

        if (!empty($multiWarehouseInventories)) {
            $sku['MultiWarehouseInventories'] = $multiWarehouseInventories;
        } else {
            if ($quantity) $sku['Quantity'] = intval($quantity);
        }

        array_push($this->skus, $sku);
        $this->isFilter = false;
    }

    public function validate()
    {
        $skus = $this->skus;

        foreach ($skus as $k => $sku) {
            $sku = $this->filter($sku, true);

            $this->validateAll($sku, 'SellerSku');
            $this->validateOne($sku, 'Quantity', 'Price', 'SalePrice', 'MultiWarehouseInventories');

            if (isset($sku['SalePrice'])) {
                $this->validateOne($sku, 'SaleStartDate', 'SaleEndDate');
            } elseif (isset($skus['SaleStartDate']) || isset($sku['SaleEndDate'])) {
                $this->validateAll($sku, 'SalePrice');
            }

            if (!empty($sku['MultiWarehouseInventories']) && is_array($sku['MultiWarehouseInventories'])) {
                foreach ($sku['MultiWarehouseInventories'] as $v) {
                    $this->validateAll($v, 'WarehouseCode');
                }
            }

            $skus[$k] = $sku;
        }

        $this->skus = $skus;
        $this->isFilter = true;
    }

    public function pack()
    {
        $_skus = !$this->isFilter ? $this->filter($this->skus, true) : $this->skus;

        $dom = new DOMDocument('1.0', 'UTF-8');

        $request = $dom->createElement('Request');
        $dom->appendChild($request);

        $product = $dom->createElement('Product');
        $request->appendChild($product);

        $skus = $dom->createElement('Skus');
        $product->appendChild($skus);

        foreach ($_skus as $_sku) {
            $sku = $dom->createElement('Sku');
            foreach ($_sku as $k => $v) {
                if ($k == 'MultiWarehouseInventories') {
                    $kv = $this->packArray($dom, $k, 'MultiWarehouseInventory', $v);
                    $isMultiWarehouse = true;
                } else {
                    $kv = $dom->createElement($k, $v);
                }
                $sku->appendChild($kv);
            }
            $skus->appendChild($sku);
        }
        unset($_skus);

        return $dom->saveXML($request);
    }

    public function clear()
    {
        $this->skus = [];
    }
}
