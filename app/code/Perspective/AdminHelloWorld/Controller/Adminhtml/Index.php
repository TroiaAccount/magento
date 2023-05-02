<?php

namespace Perspective\AdminHelloWorld\Controller\Adminhtml;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\PageFactory;
use Magento\TestFramework\Event\Magento;

class Index implements HttpGetActionInterface
{

    protected $authorization, $pageFactory;
    public function __construct(\Magento\Framework\AuthorizationInterface $authorization, PageFactory $pageFactory){
        $this->authorization = $authorization;
        $this->pageFactory = $pageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        return $this->pageFactory->create();
    }

    protected function _isAllowed(){
        $this->authorization->isAllowed('Magento_Customer::manage');
    }
}
