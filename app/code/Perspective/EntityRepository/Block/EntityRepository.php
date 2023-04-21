<?php

namespace Perspective\EntityRepository\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\View\Element\Template;

class EntityRepository extends Template
{
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $_productRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;
    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->_productRepository = $productRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }
    public function getProductById($productId)
    {
        if (!is_integer($productId)){
            return null;
        }
        $productModel = $this->_productRepository->getById($productId);
        return $productModel;
    }

    public function getCheapProducts($price){
        if (is_null($price)){
            return null;
        }
        $this->_searchCriteriaBuilder->addFilter(
            ProductInterface::PRICE,
            $price,
            'lt')->setPageSize(10);
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $productCollection = $this->_productRepository->getList($searchCriteria);
        return $productCollection->getItems();
    }

    public function getProductsByCategoryAndKeyword($categoryId, $keyword, $created_at, $pageSize)
    {
        // Устанавливаем фильтры в построитель запросов
        $this->_searchCriteriaBuilder->addFilter(ProductInterface::NAME, "%$keyword%", 'like');
        $this->_searchCriteriaBuilder->addFilter(ProductInterface::CREATED_AT, $created_at, 'gteq');
        $this->_searchCriteriaBuilder->addFilter('category_id', $categoryId);
        $this->_searchCriteriaBuilder->setPageSize($pageSize);

        // Получаем результаты поиска
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $searchResults = $this->_productRepository->getList($searchCriteria);

        // Получаем массив продуктов
        $products = $searchResults->getItems();

        return $products;
    }


}
