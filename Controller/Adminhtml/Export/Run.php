<?php

namespace Bluebird\OrderExport\Controller\Adminhtml\Export;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Run extends Action implements HttpPostActionInterface {

    public function __construct(JsonFactory $jsonFactory, Context $context) {
        parent::__construct($context)
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        return $this->jsonFactory->create([]);
    }
}