<?php

namespace Perspective\TutorialEntity\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Custom extends AbstractHelper {
    protected $_avaliableSku = [
        '24-MB05'
    ];

    public function validateProductBySku($sku){
        if(in_array($sku, $this->getAvaliableSku())){
            return true;
        }
        return false;
    }

    protected function getAvaliableSku(){
        return $this->_avaliableSku;
    }
}
