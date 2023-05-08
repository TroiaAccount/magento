<?php

namespace Perspective\Social\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\TestFramework\Event\Magento;

class Social implements ArgumentInterface
{

    protected $product, $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function setProduct($product){
        $this->product = $product;
        return $this;
    }

    public function getNewPrice(){
        $moduleStatus = $this->scopeConfig->getValue('social/general/enable');
        $response = ['enable' => $moduleStatus, 'discount' => 0, 'enable_product' => $this->product->getData('socail_enabled'), 'new_price' => $this->product->getPrice()];
        if($moduleStatus && $this->product->getData('socail_enabled')){
            $discount = $this->scopeConfig->getValue('social/general/discount');
            $response['discount'] = $discount;
            $response['new_price'] = $this->product->getPrice() - (($this->product->getPrice() * (int) $discount) / 100);
        }
        return $response;
    }



}
