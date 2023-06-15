<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Rohan Hapani
 */
namespace Troia\QuestionSaler\Block\Adminhtml\Grid\Edit;
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
        $this->addTab('main', Tab\Main::class);
        //$this->setDestElementId('reply_form');
        $this->setTitle(__('Question saler'));
    }
}
