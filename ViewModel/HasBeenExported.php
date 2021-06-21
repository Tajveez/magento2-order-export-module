<?php

namespace Bluebird\OrderExport\ViewModal;

use Bluebird\OrderExport\Service\Order as OrderService;
use Psr\Log\LoggerInterface;

class HasBeenExported
{
    const STATUS_SUCCESS = 1;
    const STATUS_NOT_YET = 2;
    const STATUS_ERROR = 3;

    private $orderService;
    private $logger;

    public function __construct(
        OrderService $orderService,
        LoggerInterface $logger
    ) {
        $this->orderService = $orderService;
        $this->logger = $logger;
    }

    public function getExportedStatus()
    {
        try {
            $exported = $this->orderService->get()
                ->getExtensionAttributes()
                ->getExportDetails()
                ->hasBeenExported();
            return $exported ?
                self::STATUS_SUCCESS : self::STATUS_NOT_YET;
        } catch (\Throwable $th) {
            $this->logger->log('Error', $th);
            return self::STATUS_ERROR;
        }
    }

    public function getExportedMessage()
    {
        switch ($this->getExportedStatus()) {
            case self::STATUS_SUCCESS:
                return __('This Order has been exported');
            case self::STATUS_NOT_YET:
                return __('This Order has not been exported');
            case self::STATUS_ERROR:
                return __('This Order is invalid');
        }
    }
}
