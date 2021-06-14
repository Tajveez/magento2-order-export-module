<?php

namespace Bluebird\OrderExport\Model;

use Bluebird\OrderExport\Api\Data\OrderExportDetailsInterface;
use Magento\Framework\Model\AbstractModel;
use Bluebird\OrderExport\Model\ResourceModel\OrderExportDetails as OrderExportDetailsResource;

class OrderExportDetails extends AbstractModel implements OrderExportDetailsInterface
{
    protected function _construct()
    {
        $this->_init(OrderExportDetailsResource::class);
    }

    /* Getters */

    public function getOrderId(): int
    {
        return $this->getData('order_id');
    }
    public function getShipOn(): \DateTime
    {
        return $this->getData('ship_on');
    }
    public function getExportedAt(): \DateTime
    {
        return $this->getData('exported_at');
    }
    public function getMerchantNotes(): string
    {
        return $this->getData('merchant_notes');
    }

    public function setOrderId(int $orderId): void
    {
        $this->setOrderId($orderId);
    }
    public function setShipOn(\DateTime $shipOn): void
    {
        $this->setShipOn($shipOn);
    }
    public function setExportedAt(\DateTime $exportedAt): void
    {
        $this->setExportedAt($exportedAt);
    }
    public function setMerchantNotes(string $merchantNotes): void
    {
        $this->setMerchantNotes($merchantNotes);
    }
}
