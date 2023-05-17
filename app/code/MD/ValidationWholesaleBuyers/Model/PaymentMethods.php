<?php

namespace MD\ValidationWholesaleBuyers\Model;

use Magento\Payment\Model\Config;

class PaymentMethods {

    protected $paymentMethods;

    public function __construct(Config $paymentMethods)
    {
        $this->paymentMethods = $paymentMethods;
    }

    public function toOptionArray(){
        $methods = $this->paymentMethods->getActiveMethods();
        $result = [];
        foreach ($methods as $method){

            if($method->isAvailable()) {
                $result[] = [
                    'label' => $method->getTitle(),
                    'value' => $method->getCode()
                ];
            }
        }
        return $result;
    }

}
