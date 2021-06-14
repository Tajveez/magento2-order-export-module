<?php

namespace Bluebird\OrderExport\Controller\Adminhtml\Export;

use Bluebird\OrderExport\Model\HeaderDataFactory;
use Bluebird\OrderExport\Orchestrator;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Run extends Action implements HttpPostActionInterface
{

	private $jsonFactory;
	private $headerDataFactory;
	private $orchestrator;

	public function __construct(
		JsonFactory $jsonFactory,
		Context $context,
		HeaderDataFactory $headerDataFactory,
		Orchestrator $orchestrator
	) {
		parent::__construct($context);
		$this->jsonFactory = $jsonFactory;
		$this->headerDataFactory = $headerDataFactory;
		$this->orchestrator = $orchestrator;
	}

	public function execute()
	{
		$headerData = $this->headerDataFactory->create();
		$headerData->setShipDate(new \DateTime($this->getRequest()->getParam('ship_date')));
		$headerData->setMerchantNotes(\htmlspecialchars($this->getRequest()->getParam('merchant_notes')));

		$this->orchestrator->run(
			$this->getRequest()->getParam('order_id'),
			$headerData
		);

		return $this->jsonFactory->create([
			'success' => true,
			'message' => 'File Exported Successful',
		]);
	}
}
