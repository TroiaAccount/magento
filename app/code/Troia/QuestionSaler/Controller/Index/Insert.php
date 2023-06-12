<?php

namespace Troia\QuestionSaler\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Troia\QuestionSaler\Model\QuestionSallerFactory;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Message\ManagerInterface;
class Insert implements HttpPostActionInterface
{

    protected $questionSallerFactory, $http, $json, $message;

    public function __construct(QuestionSallerFactory $questionSallerFactory, Http $http, JsonFactory $json, ManagerInterface $message){
        $this->questionSallerFactory = $questionSallerFactory;
        $this->http = $http;
        $this->json = $json;
        $this->message = $message;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $data = $this->http->getPostValue();
        try {
            $questionSalerModel = $this->questionSallerFactory->create();
            $questionSalerModel->setData($data);
            $questionSalerModel->save();

            return $this->json->create()->setData(['status' => true]);
        } catch (\Exception $e) {
            return $this->json->create()->setData(['status' => false, 'error' => $e]);
        }
    }
}
