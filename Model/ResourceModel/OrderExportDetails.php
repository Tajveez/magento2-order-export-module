<?php

namespace Bluebird\OrderExport\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OrderExportDetails extends AbstractDb
{
    public function _construct()
    {
        $this->_init('sales_order_export', 'id');
    }
}
