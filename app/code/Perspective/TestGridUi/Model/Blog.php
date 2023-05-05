<?php

namespace Perspective\TestGridUi\Model;

use Magento\Framework\Model\AbstractModel;
use Perspective\TestGridUi\Model\ResourceModel\Blog as ResourceModel;

class Blog extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'rh_blog_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
