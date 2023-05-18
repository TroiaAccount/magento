<?php

namespace MD\ValidationWholesaleBuyers\Model;

use Magento\Shipping\Model\Config;

class ShippingMethods {

    protected $shippingMethods;

    public function __construct(Config $paymentMethods)
    {
        $this->shippingMethods = $paymentMethods;
    }

    public function toOptionArray(){
        $methods = $this->shippingMethods->getActiveCarriers();
        $result = [];
        foreach ($methods as $method){
            $result[] = [
                'label' => $method->getConfigData('title'),
                'value' => $method->getCarrierCode()
            ];

        }
        return $result;
    }

}
