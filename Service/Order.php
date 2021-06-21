<?php

namespace Bluebird\OrderExport\Service;

use Magento\Framework\App\RequestInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class Order
{
    private $request;
    private $order;

    public function __construct(RequestInterface $request, OrderRepositoryInterface $order)
    {
        $this->request = $request;
        $this->order = $order;
    }

    public function get()
    {
        return $this->order->get(
            (int)$this->request->getParam('order_id')
        );
    }
}
