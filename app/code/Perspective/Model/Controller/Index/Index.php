<?php

namespace Perspective\Model\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;


class Index implements HttpGetActionInterface
{

    protected $_pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory){
        $this->_pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
