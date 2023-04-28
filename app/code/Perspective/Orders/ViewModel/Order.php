<?php

namespace Perspective\Orders\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
class Order implements ArgumentInterface
{
    protected $orderFactory;

    public function __construct(\Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderFactory){
        $this->orderFactory = $orderFactory;
    }

    public function getOrders(){
        $orders = $this->orderFactory->create()->addAttributeToSelect('*');
        return $orders;
    }

    public function getOrderCollectionByCustomerId($customerId)
    {
        $collection = $this->orderFactory->create($customerId)
            ->addFieldToSelect('*')

            ->setOrder(
                'created_at',
                'desc'
            );

        return $collection;

    }
}
