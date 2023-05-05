<?php

namespace Perspective\TestGridUi\Model\ResourceModel\Blog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Perspective\TestGridUi\Model\Blog as Model;
use Perspective\TestGridUi\Model\ResourceModel\Blog as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'rh_blog_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
