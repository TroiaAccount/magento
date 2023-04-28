<?php

namespace Perspective\ProductQty\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductInfo implements ArgumentInterface
{
    protected $registry;
    public function __construct(\Magento\Framework\Registry $registry){
        $this->registry = $registry;
    }
    public function getCurrentProduct(){

        return $this->registry->registry('current_product');
    }
}
