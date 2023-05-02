<?php

namespace Perspective\AdminHelloWorld\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;

class Config implements HttpGetActionInterface
{

    protected $helperData;

    public function __construct(\Perspective\AdminHelloWorld\Helper\Data $helperData)
    {
        $this->helperData = $helperData;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        echo $this->helperData->getGeneralConfig('enable');
        echo $this->helperData->getGeneralConfig('display_text');
        exit;
    }
}
