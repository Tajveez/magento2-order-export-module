<?php

declare(strict_types=1);

namespace Bluebird\OrderExport\Action;

use Bluebird\OrderExport\Model\HeaderData;
use Magento\Sales\Api\OrderRepositoryInterface;
use Bluebird\OrderExport\Api\DataCollectorInterface;

class TransformOrderToArray
{
	private $orderRepository;
	private $dataCollectors;
	public function __construct(
		OrderRepositoryInterface $orderRepository,
		array $dataCollectors
	) {
		$this->orderRepository = $orderRepository;
		$this->dataCollectors = $dataCollectors;
	}

	public function execute(
		int $orderId,
		HeaderData $headerData
	) {
		$order = $this->orderRepository->get($orderId);
		$output = [];

		foreach ($this->dataCollectors as $collector) {
			if (!($collector instanceof DataCollectorInterface)) {
				continue;
			}

			$output = array_merge($output, $collector->collect($order, $headerData));
		}
		return $output;
	}
}
