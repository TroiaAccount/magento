<?php

namespace Perspective\Cource\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Data implements ArgumentInterface
{

    protected $configScopeInterface, $product;

    public function __construct(ScopeConfigInterface $configScopeInterface)
    {
        $this->configScopeInterface = $configScopeInterface;

    }

    public function setProduct($product){
        $this->product = $product;
        return $this;
    }

    public function getData(){

        $config = $this->configScopeInterface;
        $currencies = ['uah', 'eur', 'rub'];
        $result = [];
        foreach ($currencies as $currency){
            $curr = $config->getValue("currencies/general/$currency");
            $enable =  $config->getValue("currencies/general/enable_$currency");
            if($enable){
                $result[$currency] = $this->product->getPrice() * (float) $curr;
            }
        }
        return $result;
    }

}
