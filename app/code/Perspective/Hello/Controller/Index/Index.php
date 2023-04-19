<?php
namespace Perspective\Hello\Controller\Index;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Index implements HttpGetActionInterface
{
    protected $_pageFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
    }

    public function execute()
    {

        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Hello World'));
        return $resultPage;
    }

}
