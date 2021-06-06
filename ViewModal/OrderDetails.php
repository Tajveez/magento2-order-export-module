<?php

namespace Bluebird\OrderExport\ViewModal;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\AuthorizationInterface;

class OrderDetails implements ArgumentInterface {

    private $scopeConfig;
    private $formKey;
    private $urlBuilder;
    private $request;
    private $authorization;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        FormKey $formKey,
        UrlInterface $urlBuilder,
        RequestInterface $request,
        AuthorizationInterface $authorization
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->formKey = $formKey;
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
        $this->authorization = $authorization;
    }

    public function isAllowed(): bool
    {
        return $this->scopeConfig->isSetFlag('sales/order_export/enabled')
                && $this->authorization->isAllowed('Bluebird_OrderExport::OrderExport');
    }

    public function getButtonMessage()
    {
        return (string)__('Send Orders to Fulfillment');
    }

    public function getConfig(): array
    {
        return [
            'sending_message' => __('Sending...'),
            'original_message' => $this->getButtonMessage(),
            'form_key' => $this->formKey->getFormKey(),
            'upload_url' => $this->urlBuilder->getUrl(
                'order_export/export/run',
                [
                    'order_id' => (int)$this->request->getParam('order_id')
                ]
            )
        ];
    }

    public function hasBeenExported(): bool
    {
        return false;
    }
}