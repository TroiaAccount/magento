<?php

namespace Troia\QuestionSaler\Model\ResourceModel\QuestionSaller;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Troia\QuestionSaler\Model\QuestionSaller as Model;
use Troia\QuestionSaler\Model\ResourceModel\QuestionSaller as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'question_saler_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
