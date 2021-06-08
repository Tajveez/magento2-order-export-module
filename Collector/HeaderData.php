<?php

namespace Bluebird\OrderExport\Collector;
use Bluebird/OrderExport/Api/CollectorDataInterface;
use Bluebird\OrderExport\Model\HeaderData as HeaderDataModel;
use Magento\Sales\Api\Data\OrderInterface;

class HeaderData implements CollectorDataInterface {
    public function collect(OrderInterface $order, HeaderDataModel $headerDataModel): array
    {
        return [
            'order_id' => $order->getIncrementId(),
            'ship_date' => $headerDataModel->getShipDate(),
            'merchant_notes' => $headerDataModel->getMerchantNotes()
        ];
    }
}
