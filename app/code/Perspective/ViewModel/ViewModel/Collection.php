<?php

namespace Perspective\ViewModel\ViewModel;

use Magento\Catalog\Model\Product\Visibility;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Collection implements ArgumentInterface
{
    protected $productCollectionFactory, $categoryCollectionFactory, $productVisibility;
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        Visibility $productVisibility
    )
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->productVisibility = $productVisibility;
    }

    public function getCollection(int $page = 1, int $pageSize = 5):
    \Magento\Catalog\Model\ResourceModel\Product\Collection
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setVisibility([Visibility::VISIBILITY_BOTH]);
        $collection->addCategoriesFilter(['in' => [8]]);
        $collection->setPage($page, $pageSize);
        return $collection;
    }
    public function getCategoriesByIds(array $ids):
    \Magento\Catalog\Model\ResourceModel\Category\Collection
    {
        $collection = $this->categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('entity_id', ['in' => $ids]);
        return $collection;
    }

    public function getVisibilityLabel($visibility)
    {
        return $this->productVisibility->getOptionArray()[$visibility] ?? $visibility;
    }

}
