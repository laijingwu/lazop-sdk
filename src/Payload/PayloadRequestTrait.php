<?php

namespace Lazada\OpenPlatform\Payload;

trait PayloadRequestTrait
{
    public function getData()
    {
        $data = parent::getData();

        $this->validate('payload');

        $payload = $this->getPayload();
        $payload->validate();

        $data = $this->mergeData($data, [
            'payload' => $payload->pack()
        ]);

        $data['sign'] = strtoupper($this->sign($this->apiEndpointUri, $data));

        return $data;
    }

    public function setPayload(PayloadInterface $payload)
    {
        return $this->setParameter('payload', $payload);
    }

    /**
     * @return PayloadInterface|null
     */
    public function getPayload()
    {
        return $this->getParameter('payload', null);
    }
}
