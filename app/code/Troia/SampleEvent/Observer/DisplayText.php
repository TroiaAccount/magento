<?php

namespace Troia\SampleEvent\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

/**
 * Observes the `perspective_display_text` event.
 */
class DisplayText implements ObserverInterface
{
    /**
     * Observer for perspective_display_text.
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        // TODO: Implement observer method.
    }
}
