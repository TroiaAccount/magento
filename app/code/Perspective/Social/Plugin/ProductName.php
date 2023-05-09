<?php

namespace Perspective\Social\Plugin;

use Magento\Catalog\Model\Product;
use Perspective\Social\ViewModel\Social;

class ProductName {

    protected $socail;
    public function __construct(Social $social)
    {
        $this->socail = $social;
    }


    public function afterGetName(\Magento\Catalog\Model\Product $product, $name){

        $social = $this->socail->setProduct($product);
        $getNewPrice = $social->getNewPrice();
        if($getNewPrice['enable'] && $getNewPrice['enable_product']){
            $name = "SOCIAL!!! " . $product->getData('name');
        }
        return $name;
    }

}
