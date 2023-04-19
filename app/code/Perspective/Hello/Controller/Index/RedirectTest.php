<?php

namespace Perspective\Hello\Controller\Index;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;

class RedirectTest implements HttpGetActionInterface
{

    protected $redirectFactory;
    public  function __construct(RedirectFactory $redirectFactory)
    {
        $this->redirectFactory = $redirectFactory;
    }

    public function execute()
    {
        return $this->redirectFactory->create()->setUrl('http://magento246.loc/hello/index/rawtest');
    }
}
