<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Rohan Hapani
 */
namespace Perspective\TestGridUi\Block\Adminhtml\Grid\Edit;
/**
 * Admin blog left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('grid_record');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Blog Information'));
    }
}
