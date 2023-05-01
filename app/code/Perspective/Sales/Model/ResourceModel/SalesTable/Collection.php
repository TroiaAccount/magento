<?php

namespace Perspective\Sales\Model\ResourceModel\SalesTable;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Perspective\Sales\Model\ResourceModel\SalesTable as ResourceModel;
use Perspective\Sales\Model\SalesTable as Model;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'sales_table_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
