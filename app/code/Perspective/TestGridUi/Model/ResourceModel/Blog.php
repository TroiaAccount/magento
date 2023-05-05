<?php

namespace Perspective\TestGridUi\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Blog extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'rh_blog_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('rh_blog', 'id');
        $this->_useIsObjectNew = true;
    }
}
