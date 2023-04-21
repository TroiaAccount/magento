<?php

namespace Perspective\Model\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\PageFactory;

class Specific implements HttpGetActionInterface
{

    protected $_pageFactory;

    public function __construct(\Magento\Framework\App\Action\Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
    }

    public function execute()
    {
        $page = $this->_pageFactory->create();
        $page->getConfig()->getTitle()->set('Get Categories from specific Product');
        return $page;
    }
}
