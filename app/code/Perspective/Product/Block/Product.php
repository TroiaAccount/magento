<?php

namespace Perspective\Product\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;

class Product extends Template
{
    protected $productRepository, $searchCriteriaBuilder;
    public function __construct(Template\Context $context, ProductRepositoryInterface $productRepository, SearchCriteriaBuilder $searchCriteriaBuilder, array $data = [],)
    {
        $this->productRepository = $productRepository ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Magento\Catalog\Api\ProductRepositoryInterface::class);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Magento\Framework\Api\SearchCriteriaBuilder::class);
        parent::__construct($context, $data);
    }

    public function getProductsByPrices($firstPrice, $secondPrice){
        $this->searchCriteriaBuilder->addFilter(ProductInterface::PRICE, $firstPrice, 'gt')
            ->addFilter(ProductInterface::PRICE, $secondPrice, 'lt')
            ->addFilter('category_id', 23);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $list = $this->productRepository->getList($searchCriteria);
        return $list->getItems();
    }

}
