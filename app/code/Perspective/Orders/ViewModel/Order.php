<?php

namespace Perspective\Orders\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Sales\Model\OrderFactory;

class Order implements ArgumentInterface
{
    protected $orderFactory;

    public function __construct(OrderFactory $orderFactory){
        $this->orderFactory = $orderFactory;
    }

    public function getOrders(){
        return $this->orderFactory->create()->getCollection();
    }
}
