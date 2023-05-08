<?php

namespace Perspective\ColorAttribute\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class AddEnableColorAttribute implements ArgumentInterface
{
    /** @var \Magento\Catalog\Model\Product $product */
    protected $product;

    public function setProduct($product){
        $this->product = $product;
        return $this;
    }

}
