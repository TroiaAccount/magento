<?php

namespace Perspective\Cource\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Directory\Model\CurrencyFactory;
class Data implements ArgumentInterface
{

    protected $configScopeInterface, $product, $currency;

    public function __construct(ScopeConfigInterface $configScopeInterface, CurrencyFactory $currency)
    {
        $this->configScopeInterface = $configScopeInterface;
        $this->currency = $currency;
    }

    public function setProduct($product){
        $this->product = $product;
        return $this;
    }

    public function getCurrenciesByMagento(){
        $currencies = ['uah', 'eur', 'rub'];
        $result = [];
        $currencyInterface = $this->currency->create()->load('usd');
        foreach ($currencies as $currency){
            $curr = $currencyInterface->getAnyRate($currency);
            $result[$currency] = $this->product->getPrice() * (float) $curr;
        }
        return $result;
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
