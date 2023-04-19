<?php

namespace Perspective\Hello\Block;

use Magento\Framework\View\Element\Template;

class Hello extends Template
{
    public function getText()
    {
        return 'Hello World!';
    }
}
