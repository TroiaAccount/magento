<?php

namespace Troia\CronDiscount\Model;

use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;

class CustomerGroup
{
    /**
     * @var CollectionFactory
     */
    protected $customerGroupCollection;

    /**
     * Category constructor.
     * @param CollectionFactory $customerGroupCollection
     */
    public function __construct(
        CollectionFactory $customerGroupCollection
    ) {
        $this->customerGroupCollection = $customerGroupCollection;
    }

    public function toOptionArray()
    {
        $options = $this->customerGroupCollection->create()->toOptionArray();
        return $options;
    }
}
