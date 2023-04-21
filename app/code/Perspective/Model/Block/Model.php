<?php

namespace Perspective\Model\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\View\Element\Template;

class Model extends Template
{

    private $_productFactory;
    private $_productResource;
    private $_collectionFactory;
    protected $_collectionFactoryCategory;
    protected $_registry;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Model\ResourceModel\Product $productResource,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactoryCategory,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_productFactory = $productFactory;
        $this->_productResource = $productResource;
        $this->_collectionFactory = $collectionFactory;
        $this->_collectionFactoryCategory = $collectionFactoryCategory;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }
    public function getProductById($productId){
        if (is_null($productId)){
            return null;
        }
        $productModel = $this->_productFactory->create();
        $this->_productResource->load($productModel, $productId);
        return $productModel;
    }

    public function getCheapProducts($price){
        if (is_null($price)){
            return null;
        }
        $productCollection = $this->_collectionFactory->create();
        $productCollection->addAttributeToSelect('*')->addAttributeToFilter(ProductInterface::PRICE, ['lt'=>$price])->load();
        return $productCollection->getItems();
    }

    public function getProductCollection()
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(3); // fetching only 3 products
        return $collection;
    }

    public function getProductCollectionByCategories($ids)
    {
        $collection = $this->_collectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        return $collection;
    }

    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_collectionFactoryCategory->create();
        $collection->addAttributeToSelect('*');

        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }

        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }

        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }

        // select certain number of categories
        if ($pageSize) {
            $collection->setPageSize($pageSize);
        }

        return $collection;
    }


    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

}
