<?php

namespace Bluebird\OrderExport\Controller\Adminhtml\Export;
use Bluebird\OrderExport\Model\HeaderDataFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Run extends Action implements HttpPostActionInterface {

	private $jsonFactory;
	private $headerDataFactory;

	public function __construct(JsonFactory $jsonFactory, Context $context, HeaderDataFactory $headerDataFactory) {
		parent::__construct($context);
		$this->jsonFactory = $jsonFactory;
		$this->headerDataFactory = $headerDataFactory;
	}

	public function execute() {
		$headerData = $this->headerDataFactory->create();
		$headerData->setShipDate(new \DateTime($this->getRequest()->getParam('ship_date')));
		$headerData->setMerchantNotes(\htmlspecialchars($this->getRequest()->getParam('merchant_notes')));

		return $this->jsonFactory->create([
			'success' => true,
			'message' => 'File Exported Successful',
		]);
	}
}
