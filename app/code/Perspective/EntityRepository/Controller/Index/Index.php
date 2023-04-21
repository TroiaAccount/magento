<?php

namespace Perspective\EntityRepository\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{

    protected  $_pageFactory;
    public  function __construct(Context $context, PageFactory $pageFactory){
        $this->_pageFactory = $pageFactory;
    }
    public function execute()
    {
        $page = $this->_pageFactory->create();
        $page->getConfig()->getTitle()->set('');
        return $page;
    }
}
