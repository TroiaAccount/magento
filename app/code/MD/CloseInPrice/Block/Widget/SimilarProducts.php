<?php
namespace MD\CloseInPrice\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Block\Product\View;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Wishlist\Model\ResourceModel\Item\CollectionFactory as WishlistFactory;

class SimilarProducts extends Template implements BlockInterface
{
    protected $_template = 'widget/similar_products.phtml';

    protected $wishlistFactory;
    protected $product;
    protected $order;
    protected $searchCriteriaBuilder;

    public function __construct(
        Template\Context $context,

        View $product,
        OrderRepositoryInterface $order,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        WishlistFactory $wishlistFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->product = $product->getProduct();
        $this->order = $order;
        $this->wishlistFactory = $wishlistFactory;
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
        
        $wishlistItems = $this->wishlistFactory->create();
        $wishlistItems->addFieldToFilter('product_id', $this->product->getId());
        $wishlistSize = $wishlistItems->getSize();
        return ['sales_today' => $filteredOrderList, 'wishlist' => $wishlistSize];
    }
}
