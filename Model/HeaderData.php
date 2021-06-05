<?php

namespace Bluebir\OrderExport\Model;

class HeaderData {
    /* @var \DateTime */    
    private $shipDate;
    /* @var string */
    private $merchantNotes;

    public function getShipDate(): \DateTime
    {
        return $this->shipDate;
    }

    public function setShipDate(\DateTime $shipDate): void
    {
        $this->shipDate = $shipDate;
    }

    public function getMerchantNotes(): string
    {
        return $this->merchantNotes;
    }

    public function setMerchantNotes($merchantNotes): void
    {
        return $this->merchantNotes = $merchantNotes;
    }

}