<?php

namespace Troia\PricePlugin\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;

class ChangeProductPrice
{
    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $product, $result){
        $categories = $this->scopeConfig->getValue('price/general/discount_categories');
        $categories = explode(',', $categories);
        $productCategories = $product->getCategoryIds();
        $check = array_intersect($productCategories, $categories);
        if(count($check) > 0){
            $percent = $this->scopeConfig->getValue('price/general/discount');
            $result = $result - (($result * (int) $percent) / 100);
        }

        return $result;
    }

}
