<?php

namespace Bluebird\OrderExport;

use Bluebird\OrderExport\Action\PushDetailsToWebService;
use Bluebird\OrderExport\Action\SaveExportDetailsToOrder;
use Bluebird\OrderExport\Action\TransformOrderToArray;
use Bluebird\OrderExport\Model\HeaderData;
use Magento\Framework\Exception\NoSuchEntityException;

class Orchestrator
{
	/**
	 * @var TransformOrderToArray
	 **/
	private $orderToArray;
	private $pushDetailsToWebService;
	private $saveExportDetailsToOrder;

	public function __construct(
		TransformOrderToArray $orderToArray,
		PushDetailsToWebService $pushDetailsToWebService,
		SaveExportDetailsToOrder $saveExportDetailsToOrder
	) {
		$this->orderToArray = $orderToArray;
		$this->pushDetailsToWebService = $pushDetailsToWebService;
		$this->saveExportDetailsToOrder = $saveExportDetailsToOrder;
	}

	public function run(int $orderId, HeaderData $headerData): array
	{
		$results = ['success' => false, 'error' => null];
		$orderDetails = $this->orderToArray->execute($orderId, $headerData);
		try {
			$this->pushDetailsToWebService->execute($orderId, $orderDetails);
			$results['success'] = true;
		} catch (NoSuchEntityException $ex) {
			$results['error'] = $ex->getMessage();
		} catch (\Throwable $th) {
			$results['error'] = $th->getMessage();
		}
		$this->saveExportDetailsToOrder->execute($orderId, $results, $headerData);
		return $results;
	}
}
