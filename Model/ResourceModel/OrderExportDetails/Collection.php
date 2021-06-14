<?php

namespace Bluebird\OrderExport\Model\ResourceModel\OrderExportDetails;

use Bluebird\OrderExport\Model\OrderExportDetails as ModelOrderExportDetails;
use Bluebird\OrderExport\Model\ResourceModel\OrderExportDetails as ResourceModelOrderExportDetails;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(ModelOrderExportDetails::class, ResourceModelOrderExportDetails::class);
    }
}
