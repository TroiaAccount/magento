<?php
namespace Perspective\TestGridUi\Controller\Adminhtml\Grid;

use Laminas\ReCaptcha\Exception;
use Perspective\TestGridUi\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\App\Request\Http;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;

class MassStatus implements \Magento\Framework\App\Action\HttpPostActionInterface
{

    protected $collectionFactory, $request, $redirectFactory, $messageManager;
    public function __construct(CollectionFactory $collectionFactory, Http $request, RedirectFactory $redirectFactory, ManagerInterface $messageManager)
    {
        $this->collectionFactory = $collectionFactory;
        $this->request = $request;
        $this->redirectFactory = $redirectFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $ids = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('id', ['in' => $ids]);
        $updateStatus = 0;
        try{
            foreach ($collection as $item){
                $item->setStatus($status)->save();
                $updateStatus++;
            }
        } catch (Exception $e){
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while updating the product(s) status'));
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been updated', $updateStatus));
        return $this->redirectFactory->create()->setPath('*/*/');
    }
}
