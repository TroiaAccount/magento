<?php

namespace Troia\ShippingMethodExample\Plugin;

class ValidateShippingPrice
{
    public function afterCollectRates(\Magento\Shipping\Model\Carrier\AbstractCarrier $subject, \Magento\Shipping\Model\Rate\Result  $result)
    {

        $rates = $result->getRatesByCarrier('customshipping');
        foreach ($rates as $rate){
            $price = $rate->getData('price');
            if($price < 2){
                $price = 2;
            }
            $rate->setPrice($price);
        }
        return $result;
    }
}
