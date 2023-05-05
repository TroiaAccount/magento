<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Rohan Hapani
 */
namespace Perspective\TestGridUi\Controller\Adminhtml\Grid;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\View\LayoutFactory;
/**
 * Grid Controller
 */
class Grid implements HttpGetActionInterface
{
    /**
     * @var Raw
     */
    protected $resultRawFactory;
    /**
     * @var LayoutFactory
     */
    protected $layoutFactory;

    /**
     * $context
     * @param Raw
     * $resultRawFactory
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(
        Raw    $resultRawFactory,
        LayoutFactory $layoutFactory
    )
    {
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
    }

    public function execute()
    {
        $resultRaw = $this->resultRawFactory;
        $blogHtml = $this->layoutFactory->create()->createBlock(
            'Perspective\TestGridUi\Block\Adminhtml\Grid\Grid',
            'grid.view.grid'
        )->toHtml();
        return $resultRaw->setContents($blogHtml);
    }
}
