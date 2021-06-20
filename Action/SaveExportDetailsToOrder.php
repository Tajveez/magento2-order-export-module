<?php

namespace Bluebird\OrderExport\Action;

use Bluebird\OrderExport\Model\HeaderData as ModelHeaderData;
use Bluebird\OrderExport\Model\OrderExportDetailsRepository;
use Magento\Sales\Api\OrderRepositoryInterface;

class SaveExportDetailsToOrder
{
    private $orderRepository;
    private $exportDetailsRepository;
    public function __construct(OrderRepositoryInterface $orderRepository, OrderExportDetailsRepository $exportDetailsRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->exportDetailsRepository = $exportDetailsRepository;
    }

    public function execute(int $orderId, array $results, ModelHeaderData $headerData)
    {
        $order = $this->orderRepository->get($orderId);
        $details = $order->getExtensionAttributes()->getOrderExportDetials();

        if ($results['success'] && $results['success'] === true) {
            $details->setExportedAt(new \DateTime());
        }

        $details->setOrderId($orderId);
        $details->setMerchantNotes($headerData->getMerchantNotes());
        $details->setShipOn($headerData->getShipOn());

        $this->exportDetailsRepository->save($details);
    }
}
