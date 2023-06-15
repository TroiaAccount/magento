<?php

namespace Troia\QuestionSaler\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Area;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\Store;
use Troia\QuestionSaler\Model\QuestionSallerFactory;
use Magento\Framework\Mail\Template\TransportBuilder;

class Save implements HttpPostActionInterface {

    protected $pageFactory, $questionSaller, $http, $redirect, $admin, $registry, $transportBuilder;

    /**
     * @param PageFactory $pageFactory
     * @param QuestionSallerFactory $questionSallerFactory
     * @param Http $http
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(PageFactory $pageFactory, QuestionSallerFactory $questionSallerFactory, Http $http, RedirectFactory $redirectFactory, TransportBuilder $transportBuilder)
    {
        $this->pageFactory = $pageFactory;
        $this->questionSaller = $questionSallerFactory;
        $this->http = $http;
        $this->redirect = $redirectFactory;
        $this->transportBuilder = $transportBuilder;
    }

    public function execute()
    {
        $inputs = $this->http->getParams();
        $id = $this->http->getPostValue('id');
        $resultPage = $this->pageFactory->create();
        $model = $this->questionSaller->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $resultPage = $this->pageFactory->create(ResultFactory::TYPE_REDIRECT);
                return $this->redirect->create()->setPath('*/*/');
            }
        }

        if(!is_null($inputs['answer']) && $inputs['answer'] != ''){
            $send = $this->transportBuilder->setTemplateIdentifier(1)
                ->setTemplateOptions([
                    'area' => Area::AREA_FRONTEND,
                    'store' => Store::DEFAULT_STORE_ID
                ])
                ->addTo([$model->getEmail() => $model->getName()])
                ->setFrom(['email' => 'vadym.queensoft@gmail.com', 'name' => 'Saler'])
                ->setReplyTo('vadym.queensoft@gmail.com')
                ->setTemplateIdentifier(1)
                ->setTemplateVars(['recipient_name' => $model->getName(), 'answer' => $inputs['answer']])
                ->getTransport();

            $send->sendMessage();
            $inputs['status'] = 1;
        }

        $model->setData($inputs);
        $model->save();
        return $this->redirect->create()->setPath('*/*/');
    }

}
