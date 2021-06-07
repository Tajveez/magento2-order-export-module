<?php

namespace Bluebird\OrderExport;
use Bluebird\OrderExport\Action\TransformOrderToArray;
use Bluebird\OrderExport\Model\HeaderData;

class Orchestrator {
	/**
	 * @var TransformOrderToArray
	 **/
	private $orderToArray;

	public function __construct(TransformOrderToArray $orderToArray) {
		$this->orderToArray = $orderToArray;
	}

	public function run(int $orderId, HeaderData $headerData): array{
		$results = ['success' => false, 'error' => null];
		$orderDetails = $this->orderToArray->execute($orderId, $headerData);

		return $results;
	}
}
