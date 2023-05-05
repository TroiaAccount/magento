<?php

namespace Perspective\TestGridUi\Controller\Adminhtml\Grid;

use Laminas\ReCaptcha\Exception;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\App\Request\Http;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Delete implements HttpPostActionInterface
{

    protected $blogFactory, $authorizationInterface, $request, $redirectFactory;

    public function __construct(RedirectFactory $redirectFactory, \Perspective\TestGridUi\Model\BlogFactory $blogFactory, AuthorizationInterface $authorizationInterface, Http $request)
    {
        $this->redirectFactory = $redirectFactory;
        $this->blogFactory = $blogFactory;
        $this->request = $request;
        $this->authorizationInterface = $authorizationInterface;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->authorizationInterface->isAllowed('Perspective_TestGridUi::view');
    }

    public function execute()
    {
        $id = $this->request->getParam('id');

        $resultRedirect = $this->redirectFactory->create();
        if($id){
            try {
                $model = $this->blogFactory->create();
                $model->load($id);
                $model->delete();

                return $resultRedirect->setPath('/');
            } catch (Exception $e){

                return $resultRedirect->setPath('*/*/index', ['id' => $id]);
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
