<?php
namespace MD\CloseInPrice\Block\Widget;

use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Block\Product\View;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class SimilarProducts extends Template implements BlockInterface
{
    protected $_template = 'widget/similar_products.phtml';

    protected $collectionFactory;
    protected $visibility;
    protected $product;
    protected $order;
    protected $searchCriteriaBuilder;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Visibility $visibility,
        View $product,
        OrderRepositoryInterface $order,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->product = $product->getProduct();
        $this->collectionFactory = $collectionFactory;
        $this->visibility = $visibility;
        $this->order = $order;
    }

    public function getPriceDifference()
    {
        return (float) $this->getData('price_difference');
    }

    public function getProduct(){
        return $this->product;
    }

    public function getSimilarProducts()
    {
        $categoryId = $this->product->getCategoryIds();
        $currentDate = date('Y-m-d');

        $orderList = $this->order->getList(
            $this->searchCriteriaBuilder
                ->addFilter('created_at', $currentDate, 'gteq')
                ->create()
        )->getItems();
        
        $filteredOrderList = [];
        foreach ($orderList as $order) {
            $orderItems = $order->getItems();
        
            foreach ($orderItems as $orderItem) {
                $productCategories = $orderItem->getProduct()->getCategoryIds();
        
                foreach ($productCategories as $productCategoryId) {
                    if (in_array($productCategoryId, $categoryId)) {
                        $filteredOrderList[] = $orderItem->getProduct();
                        break;
                    }
                }
            }
        }
        

        return $filteredOrderList;
    }
}
