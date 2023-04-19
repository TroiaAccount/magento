<?php

namespace Perspective\Hello\Controller\Index;

use Magento\Backend\Model\View\Result\Forward;
use Magento\Framework\App\Action\HttpGetActionInterface;

class ForwardTest implements HttpGetActionInterface
{
    protected $forward;
    public  function __construct(Forward $forward){
        $this->forward = $forward;
    }
    public function execute()
    {
        return $this->forward->forward('JsonTest');
    }
}
