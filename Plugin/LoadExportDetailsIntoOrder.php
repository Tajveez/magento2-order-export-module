<?php

namespace Bluebird\OrderExport\Plugin;

use Bluebird\OrderExport\Model\OrderExportDetailsFactory;
use Bluebird\OrderExport\Model\OrderExportDetailsRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderExtensionFactory;

/**
 *
 */
class LoadExportDetailsIntoOrder
{
	private $extensionFactory;
	private $orderExportDetailsRepository;
	private $searchCriteriaBuilder;
	private $detailsFactory;

	public function __construct(
		OrderExtensionFactory $extensionFactory,
		OrderExportDetailsFactory $detailsFactory,
		OrderExportDetailsRepository $orderExportDetailsRepository,
		SearchCriteriaBuilder $searchCriteriaBuilder
	) {
		$this->extensionFactory = $extensionFactory;
		$this->detailsFactory = $detailsFactory;
		$this->orderExportDetailsRepository = $orderExportDetailsRepository;
		$this->searchCriteriaBuilder = $searchCriteriaBuilder;
	}

	function afterGet(OrderRepositoryInterface $subject, OrderInterface $order)
	{
		return $this->injectDetails($order);
	}

	public function afterGetList(OrderRepositoryInterface $subject, OrderSearchResultInterface $results)
	{
		foreach ($results->getItems() as $order) {
			$this->injectDetails($order);
		}

		return $result;
	}

	public function injectDetails($order)
	{
		$extensionAttributes = $order->getExtensionAttributes() ?? $this->extensionFactory->create();
		$details = $this->orderExportDetailsRepository->getList(
			$this->searchCriteriaBuilder->addFilter(
				'order_id',
				$order->getEntityId()
			)->create()
		)->getItems();

		if (count($details)) {
			$extensionAttributes->setOrderExportDetails(reset($details));
		} else {
			$extensionAttributes->setOrderExportDetails($this->detailsFactory->create());
		}

		$order->setExtensionAttributes($extensionAttributes);
		return $order;
	}
}
