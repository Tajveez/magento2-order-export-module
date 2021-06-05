<?php

namespace Bluebir\OrderExport\Model;

class HeaderData {
    /* 
    Class to contain data, take information 
    and make it available to other classes
    that are going to process that data.

    [HTTP Request] -> [      Controller       ]
                    \                      \
                    [Build HeaderData]  -> [Call Orchestrator] -> [Return Results]
    */

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