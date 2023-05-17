<?php

namespace MD\CustomPayment\Model;

/**
 * MD Custom Payment Method Model
 */
class PaymentMethod extends \Magento\Payment\Model\Method\AbstractMethod {

    /**
     * Payment Method code
     *
     * @var string
     */
    protected $_code = 'custompayment';

    public function isAvailable(\Magento\Quote\Api\Data\CartInterface $quote = null)
    {
        if ($quote && $quote->getShippingAddress()->getShippingMethod() === 'customshipping_customshipping') {
            return true;
        }
        return false;
    }
}
