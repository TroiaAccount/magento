<?php

namespace Perspective\ViewModel\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class MyNewViewModel implements ArgumentInterface
{
    public function getTitle(){
        return "Hello World";
    }
}
