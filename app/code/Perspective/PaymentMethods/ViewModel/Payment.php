<?php

namespace Perspective\PaymentMethods\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Payment\Helper\Data;
class Payment implements ArgumentInterface
{

    protected $paymentMethod, $paymentHelper;

    public function __construct(Data $paymentHelper){
        $this->paymentHelper = $paymentHelper;
    }

    public function getPaymentMethodList(){
        return $this->paymentHelper->getPaymentMethodList();
    }

    public function check(){
        return "ghel";
    }

}
