<?php

namespace Troia\FinalPriceObserver\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

/**
 * Observes the `catalog_controller_product_view` event.
 */
class ChangePriceProductViewObserver implements ObserverInterface
{
    /**
     * Observer for catalog_controller_product_view.
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();
        $originalPrice = $product->getFinalPrice();
        $resultPrice = $originalPrice + (($originalPrice * 20) / 100);
        $product->setPrice($resultPrice);
    }
}
