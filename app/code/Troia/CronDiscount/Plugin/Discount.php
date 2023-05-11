<?php

namespace Troia\CronDiscount\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Customer\Model\Session;

class Discount {
    protected $scopeConfigInterface, $customer;

    public function __construct(ScopeConfigInterface $scopeConfigInterface, Session $session)
    {
        $this->scopeConfigInterface = $scopeConfigInterface;
        $this->customer = $session;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $product, $price){
        $enable = $this->scopeConfigInterface->getValue('cron_discount/general/enable');
        if($enable == 1){ // Проверяем включена скидка или нет
            $categories = $this->scopeConfigInterface->getValue('cron_discount/general/discount_categories');
            $product_categories = $product->getCategoryIds();
            $categories = explode(',', $categories);
            $check = array_intersect($product_categories, $categories);
            if(count($check) > 0){ // проверяем входит ли категория продукта в скидку
                $customerGroups = $this->scopeConfigInterface->getValue('cron_discount/general/customer_group');
                $customerGroups = explode(',', $customerGroups);
                if(in_array($this->customer->getCustomer()->getGroupId(), $customerGroups)) { // проверяем входит ли группа покупателей под скидку
                    $discount = $this->scopeConfigInterface->getValue('cron_discount/general/discount');
                    $price = $price - (($price * (int)$discount) / 100);
                }
            }

        }
        return $price;
    }
}
