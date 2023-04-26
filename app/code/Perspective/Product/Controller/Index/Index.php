<?php

namespace Perspective\Product\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    protected $_pageFactory;
    public function __construct(\Magento\Framework\App\Action\Context $context, PageFactory $pageFactory){
        $this->_pageFactory = $pageFactory;
    }
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
