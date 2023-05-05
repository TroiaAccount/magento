<?php
    namespace Perspective\TestGridUi\Controller\Adminhtml\Grid;

    use Magento\Framework\App\Action\HttpPostActionInterface;
    use Perspective\TestGridUi\Model\ResourceModel\Blog\CollectionFactory;
    use Magento\Framework\App\Request\Http;
    use Magento\Backend\Model\View\Result\RedirectFactory;
    class MassDelete implements HttpPostActionInterface{

        protected $request, $collectionFactory, $redirectFactory;

        /**
         * @param CollectionFactory $collectionFactory
         * @param Http $http
         * @param RedirectFactory $redirectFactory
         */
        public function __construct(CollectionFactory $collectionFactory, Http $http, RedirectFactory $redirectFactory)
        {
            $this->redirectFactory = $redirectFactory;
            $this->request = $http;
            $this->collectionFactory = $collectionFactory;
        }

        public function execute()
        {
            $deleteIds = $this->request->getPost('id');
            $collection = $this->collectionFactory->create();
            $collection->addFieldToFilter('id', ['in' => $deleteIds]);
            foreach ($collection as $item) {
                $item->delete();
            }

            return $this->redirectFactory->create()->setPath('*/*/');
        }
    }
?>
