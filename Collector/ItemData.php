<?php
namespace Bluebird\OrderExport\Collector;
use Bluebird\OrderExport\Api\DataCollectorInterface;
use Bluebird\OrderExport\Model\HeaderData;
use Magento\Sales\Api\Data\OrderInterface;

class ItemData implements DataCollectorInterface {

	private $allowedProductTypes;
	private $productCollectionFactory;
	public function __construct(array $allowedProductTypes,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
	) {
		$this->allowedProductTypes = $allowedProductTypes;
		$this->productCollectionFactory = $productCollectionFactory;
	}

	public function collect(OrderInterface $order, HeaderData $headerData): array
	{
		/*$output = [];*/
		$orderItems = $order->getItems();
		$orderItems = array_filter($orderItems, function (OrderInterface $orderItem) {
			return in_array($this->getProductTypeFor($orderItem->getProductId()), $this->allowedProductTypes);
		});

		return array_map(function ($item) {
			return [
				"sku" => $item->getProduct()->getSku(),
				"qty" => $item->getQtyOrdered(),
				"item_price" => $item->getBasePrice(),
				"item_cost" => $item->getBaseCost(),
				"total" => $item->getRowTotal(),
			];
		}, $orderItems);
		/*
			        foreach ($orderItems as $item) {
			        return [
			            "sku" => $item->getProduct()->getSku(),
			            "qty" => $item->getQtyOrdered(),
			            "item_price" => $item->getBasePrice(),
			            "item_cost" => $item->getBaseCost(),
			            "total" => $item->getRowTotal(),
			        ];
			    }

			    return $output;
		*/
	}

	private function getProductTypeFor(int $productId): string{
		$collection = $this->productCollectionFactory->create();
		$collection->addFieldToFilter('entity_id', ['eq' => $productId]);
		$product = $collection->getFirstItem();

		if (!$product->getId()) {
			throw new NoSuchEntityException(__('This Product doesnt exists'));
		}

		return $product->getTypeId();
	}
}
