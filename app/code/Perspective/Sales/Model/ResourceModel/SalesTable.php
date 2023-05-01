<?php

namespace Perspective\Sales\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class SalesTable extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'sales_table_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('sales_table', 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
