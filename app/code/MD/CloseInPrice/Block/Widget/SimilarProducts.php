<?php
namespace MD\CloseInPrice\Block\Widget;

use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Block\Product\View;
class SimilarProducts extends Template implements BlockInterface
{
    protected $_template = 'widget/similar_products.phtml';

    protected $collectionFactory;
    protected $visibility;
    protected $product;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Visibility $visibility,
        View $product,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->product = $product->getProduct();
        $this->collectionFactory = $collectionFactory;
        $this->visibility = $visibility;
    }

    public function getPriceDifference()
    {
        return (float) $this->getData('price_difference');
    }

    public function getSimilarProducts()
    {
        $categoryId = $this->product->getCategoryIds()[0] ?? false;
        if (!$categoryId) {
            return [];
        }

        $productCollection = $this->collectionFactory->create();
        $productCollection->addCategoriesFilter(['eq' => $categoryId]);
        $productCollection->setVisibility($this->visibility->getVisibleInCatalogIds());
        $productCollection->addFinalPrice();
        $productCollection->addAttributeToSelect('*');

        $price = $this->product->getFinalPrice();
        $priceDifference = $this->getPriceDifference();
        $minPrice = $price - $priceDifference;
        $maxPrice = $price + $priceDifference;

        $productCollection->addAttributeToFilter('price', ['between' => [$minPrice, $maxPrice]]);

        return $productCollection;
    }
}
