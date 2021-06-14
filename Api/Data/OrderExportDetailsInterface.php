<?php

namespace Bluebird\OrderExport\Api\Data;

interface OrderExportDetailsInterface
{
    /* Getters */
    public function getOrderId(): int;
    public function getShipOn(): \DateTime;
    public function getExportedAt(): \DateTime;
    public function getMerchantNotes(): string;

    /* Setters */
    public function setOrderId(int $orderId): void;
    public function setShipOn(\DateTime $shipOn): void;
    public function setExportedAt(\DateTime $exportedAt): void;
    public function setMerchantNotes(string $merchantNotes): void;
}
