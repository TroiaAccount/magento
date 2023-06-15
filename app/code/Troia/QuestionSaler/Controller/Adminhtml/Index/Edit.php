<?php

namespace Troia\QuestionSaler\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Troia\QuestionSaler\Model\QuestionSallerFactory;
use Magento\Backend\Model\Session;

class Edit implements HttpGetActionInterface {

    protected $pageFactory, $questionSaller, $http, $redirect, $admin, $registry;

    public function __construct(PageFactory $pageFactory,
                                QuestionSallerFactory $questionSallerFactory,
                                Http $http,
                                RedirectFactory
                                $redirectFactory,
                                Session $admin,
                                \Magento\Framework\Registry $registry)
    {
        $this->admin = $admin;
        $this->pageFactory = $pageFactory;
        $this->questionSaller = $questionSallerFactory;
        $this->http = $http;
        $this->redirect = $redirectFactory;
        $this->registry = $registry;
    }

    protected function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create(ResultFactory::TYPE_PAGE);
     //   $resultPage->setActiveMenu('Troia_QuestionSaler::question_saler')->addBreadcrumb(__('Blog'), __('Blog'))->addBreadcrumb(__('Manage Blog'), __('Manage Blog'));
        return $resultPage;
    }


    public function execute()
    {
        $id = $this->http->getParam('id');
        $model = $this->questionSaller->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $resultRedirect = $this->pageFactory->create(ResultFactory::TYPE_REDIRECT);
                return $this->redirect->create()->setPath('*/*/');
            }
        }

        $data = $this->admin->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register('troia_questionsaler_form_data', $model);
        $resultPage = $this->_initAction();
        return $this->pageFactory->create();
    }

}
