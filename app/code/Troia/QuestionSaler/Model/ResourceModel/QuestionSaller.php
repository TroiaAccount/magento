<?php

namespace Troia\QuestionSaler\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class QuestionSaller extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'question_saler_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('question_saler', 'id');
        $this->_useIsObjectNew = true;
    }
}
