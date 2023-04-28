<?php

namespace Perspective\Delivery\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Shipping\Model\Config\Source\Allmethods;

class Shiping implements ArgumentInterface
{

    protected $shipping;

    public function __construct(Allmethods $shipping)
    {
        $this->shipping = $shipping;
    }

    public function getAllShippigMethods(){
        return $this->shipping->toOptionArray();
    }

    public function getActiveShippingMethods(){
        return $this->shipping->toOptionArray(true);
    }

}
