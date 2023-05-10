<?php

namespace Troia\SampleEvent\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Event\ManagerInterface;

class TestEvent implements HttpGetActionInterface
{

    protected $eventManager;

    public function __construct(ManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $textDisplay = new \Magento\Framework\DataObject(array('text' => 'Perspective'));
        $this->eventManager->dispatch('perspective_display_text', ['mp_text' => $textDisplay]);
        echo $textDisplay->getText();
        exit;
    }
}
