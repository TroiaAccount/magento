<?php

namespace Troia\QuestionSaler\Model;

use Magento\Framework\Model\AbstractModel;
use Troia\QuestionSaler\Model\ResourceModel\QuestionSaller as ResourceModel;

class QuestionSaller extends AbstractModel
{

    public const STATUS_PENDING = 0;
    public const STATUS_SEND = 1;
    public const STATUS_CLOSE = 2;

    /**
     * @var string
     */
    protected $_eventPrefix = 'question_saler_model';

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
