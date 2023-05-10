<?php

namespace Troia\ObserverExample\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class ProductEventsObserver implements ObserverInterface
{
    /**
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        //$myEventData = $observer->getData('myEventData');
        $product = $observer->getProduct();
        $originalName = $product->getName();
        $modifiedName = $originalName . ' - Content added by Perspective';
        $product->setName($modifiedName);
    }
}
