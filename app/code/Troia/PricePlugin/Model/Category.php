<?php

namespace Troia\PricePlugin\Model;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;


class Category
{
    /**
     * @var CollectionFactory
     */
    protected $_categoryCollectionFactory;

    /**
     * Category constructor.
     * @param CollectionFactory $categoryCollectionFactory
     */
    public function __construct(
        CollectionFactory $categoryCollectionFactory
    ) {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        $categories = $this->_categoryCollectionFactory->create()->addAttributeToSelect('*')->getItems();
        foreach ($categories as $category) {
            $options[] = ['label' => $category->getName(), 'value' => $category->getId()];
        }
        return $options;
    }
}
