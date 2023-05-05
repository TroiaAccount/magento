<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Rohan Hapani
 */
namespace Perspective\TestGridUi\Controller\Adminhtml\Grid;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Request;

/**
 * Edit form controller
 */
class Edit implements HttpPostActionInterface
{
    protected $pageFactory, $request, $resultFactory;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    /**
     * @var \Magento\Backend\Model\Session
     */
    protected $adminSession;

    /**
     * @var \Perspective\TestGridUi\Model\BlogFactory
     */
    protected $blogFactory;
    /**
     * @param Action\Context
    $context
     * @param \Magento\Framework\Registry
    $registry
     * @param \Magento\Backend\Model\Session $adminSession
     * @param \Perspective\TestGridUi\Model\BlogFactory
    $blogFactory
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\Session $adminSession,
        \Perspective\TestGridUi\Model\BlogFactory $blogFactory,
        PageFactory $pageFactory,
        Request\Http $request,
        ResultFactory $resultFactory
    ) {
        $this->_coreRegistry = $registry;
        $this->adminSession = $adminSession;
        $this->blogFactory = $blogFactory;
        $this->pageFactory = $pageFactory;
        $this->request = $request;
        $this->resultFactory = $resultFactory;
    }
    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return true;
    }

    protected function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Perspective_TestGridUi::grid')->addBreadcrumb(__('Blog'), __('Blog'))->addBreadcrumb(__('Manage Blog'), __('Manage Blog'));
        return $resultPage;
    }

    public function execute()
    {
        $id = $this->request->getParam('id');
        $model = $this->blogFactory->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->adminSession->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('perspective_testgridui_form_data', $model);
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb($id ? __('Edit Post') : __('New Blog'), $id ? __('Edit Post') : __('New Blog'));
        $resultPage->getConfig()->getTitle()->prepend(__('Grids'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Blog'));
        return $resultPage;
    }
}
