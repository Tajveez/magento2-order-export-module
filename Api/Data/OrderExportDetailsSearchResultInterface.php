<?php

namespace Bluebird\OrderExport\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface OrderExportDetailsSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Bluebird\OrderExport\Api\Data\OrderExportDetailsInterface[]
     **/
    public function getItems();

    /**
     * @param \Bluebird\OrderExport\Api\Data\OrderExportDetailsInterface[] $items
     * @return $this
     **/
    public function setItems(array $items);
}
