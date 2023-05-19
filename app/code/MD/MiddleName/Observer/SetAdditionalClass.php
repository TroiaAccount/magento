<?php
namespace MD\MiddleName\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class SetAdditionalClass implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();

        if ($block instanceof \Magento\Sales\Block\Adminhtml\Order\Create\Form\Address) {
            $shippingMethod = $block->getQuote()->getShippingAddress()->getShippingMethod();
            $middleNameField = $block->getForm()->getElement('middlename');

            if ($middleNameField) {
                $middleNameField->setRequired(false);
                $middleNameField->removeClass('required');
                if ($shippingMethod === 'flatrate_flatrate') {
                    $middleNameField->setRequired(true);
                    $middleNameField->addClass('required');
                }
            }

        }
    }
}
