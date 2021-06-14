<?php

namespace Bluebird\OrderExport\Action;

use Magento\Framework\Exception\NoSuchEntityException;

class PushDetailsToWebService
{
    public function execute(int $orderId, array $orderDetails): void
    {
        // Call Guzzle
        throw new NoSuchEntityException(__('Detials don\'t exist'));
    }
}
