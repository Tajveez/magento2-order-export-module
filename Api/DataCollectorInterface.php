<?php

namespace Bluebird\OrderExport\Api;

use Bluebird\OrderExport\Model\HeaderData;
use Magento\Sales\Api\Data\OrderInterface;

interface DataCollectorInterface
{
	public function collect(OrderInterface $order, HeaderData $headerData): array;
}
