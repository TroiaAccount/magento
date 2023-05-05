<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Rohan Hapani
 */
namespace Perspective\TestGridUi\Controller\Adminhtml\Grid;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * New Record Form Controller
 */
class NewAction implements HttpPostActionInterface
{
    /**
     * @var \Magento\Backend\Model\View\Result\Forward
     */
    protected $resultForwardFactory;
    /**
     * @param \Magento\Backend\App\Action\Context
    $context
     * @param \Magento\Backend\Model\View\Result\Forward
    $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\Model\View\Result\Forward $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
    }
    /**
     * Create new blog record page
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory;
        return $resultForward->forward('edit');
    }
    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return true;
    }
}
