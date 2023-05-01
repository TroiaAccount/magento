<?php

namespace Perspective\Sales\Model;

use Magento\Framework\Model\AbstractModel;
use Perspective\Sales\Model\ResourceModel\SalesTable as ResourceModel;

class SalesTable extends AbstractModel
{

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    /**
     * @var string
     */
    protected $_eventPrefix = 'sales_table_model';

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
