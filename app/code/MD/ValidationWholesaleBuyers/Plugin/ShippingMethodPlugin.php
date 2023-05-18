<?php
namespace MD\ValidationWholesaleBuyers\Plugin;

use Magento\Quote\Model\Quote;
use Magento\Shipping\Model\Rate\Result;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ShippingMethodPlugin
{
    protected $session, $scopeConfigInterface;

    public function __construct(Session $session, ScopeConfigInterface $scopeConfigInterface)
    {

        $this->session = $session;
        $this->scopeConfigInterface = $scopeConfigInterface;
    }


    public function afterGetAllRates(
        Result $rateResult,
        $result,
    ) {

        $quote = $this->session->getQuote();
        $customerGroupId = $quote->getCustomer()->getGroupId();
        $carrier = $result[0]->getCarrier();

        if ($carrier == "freeshipping" && $customerGroupId != 5 && $customerGroupId != 6) {
            return [];
        }

        switch ($customerGroupId) {
            case 5:
                $getScopeConfigProductCount = $this->scopeConfigInterface->getValue('whosales_buyers/general/whosales') ?? 0;
                $getScopeConfigShippingMethod = $this->scopeConfigInterface->getValue('whosales_buyers/general/avaliable_shipping_method');
                $itemsCount = (int) $quote->getItemsCount();
                if($itemsCount > $getScopeConfigProductCount && $carrier != $getScopeConfigShippingMethod){
                    return [];
                }
                break;

            case 6:
                $getScopeConfigProductCount = $this->scopeConfigInterface->getValue('whosales_buyers/general/large_wholesale') ?? 0;
                $subtotal = (float) $quote->getSubtotal();
                if($subtotal > $getScopeConfigProductCount && $carrier != 'freeshipping'){
                    return [];
                }
                break;
        }

        return $result;
    }
}
