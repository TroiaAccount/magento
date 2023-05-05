<?php
    namespace Perspective\TestGridUi\Controller\Adminhtml\Grid;

    use Magento\Framework\App\Action\HttpPutActionInterface;
    use Magento\Framework\Exception\LocalizedException;
    use Perspective\TestGridUi\Model\BlogFactory;
    use Magento\Backend\Model\Auth\Session;
    use Magento\Framework\App\Request\Http;
    use Magento\Backend\Model\View\Result\RedirectFactory;
    use Magento\Framework\Message\ManagerInterface;

    class Save implements HttpPutActionInterface
    {

        protected $blogFactory, $session, $request, $redirectFactory, $messageManager;

        public function __construct(BlogFactory $blogFactory, Session $session, Http $request, RedirectFactory $redirectFactory, ManagerInterface $messageManager)
        {
            $this->messageManager = $messageManager;
            $this->redirectFactory = $redirectFactory;
            $this->request = $request;
            $this->session = $session;
            $this->blogFactory = $blogFactory;
        }

        public function execute()
        {
            $postObj = $this->request->getPostValue();
            $name = $postObj['name'];
            $date = date('Y-m-d');
            $username = $this->session->getUser()->getFirstName();
            if($username != $name){
                $username = $name;
            }

            $userDetail = ['name' => $username, 'created_at' => $date];
            $data = array_merge($postObj, $userDetail);
            $redirectFactory = $this->redirectFactory->create();
            if($data){
                $model = $this->blogFactory->create();
                $id = $this->request->getParam('id');
                if($id){
                    $model->load($id);
                }
                $model->setData($data);
                try {
                    $model->save();
                    if($this->request->getParam('back')){
                        return $this->redirectFactory->create()->setPath('blog/*/edit', ['id' => $model->getId(), '_current' => true]);
                    }
                    return $redirectFactory->setPath('*/*/');
                } catch (LocalizedException $e){
                    $this->messageManager->addExceptionMessage($e, 'Error');
                    return $redirectFactory->setPath('*/*/edit', ['id' => $this->request->getParam('id')]);
                }
            }
        }
    }
?>
