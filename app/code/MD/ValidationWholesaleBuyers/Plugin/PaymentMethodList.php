<?php
namespace MD\ValidationWholesaleBuyers\Plugin;

use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Payment\Model\MethodList;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Payment\Helper\Data;
class PaymentMethodList
{
    protected $cartRepository;
    protected $scopeConfig;
    protected $paymentFactory;

    /**
     * @param CartRepositoryInterface $cartRepository
     * @param ScopeConfigInterface $scopeConfig
     * @param Data $paymentFactory
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        ScopeConfigInterface $scopeConfig,
        Data $paymentFactory
    ) {
        $this->cartRepository = $cartRepository;
        $this->scopeConfig = $scopeConfig;
        $this->paymentFactory = $paymentFactory;
    }

    public function afterGetAvailableMethods(MethodList $subject, $methods, CartInterface $quote = null)
    {
        if(!is_null($quote)) {
            $customerGroupId = $quote->getCustomer()->getGroupId();
            if ($customerGroupId == 5 || $customerGroupId == 6) {
                switch ($customerGroupId) {
                    case 5:
                        $getScopeConfigProductCount = $this->scopeConfig->getValue('whosales_buyers/general/whosales') ?? 0;
                        $itemsCount = $quote->getItemsCount();
                        if($itemsCount > $getScopeConfigProductCount){
                            $getScopeConfigPaymentMethod = $this->scopeConfig->getValue('whosales_buyers/general/avaliable_payment_method');
                            $methods = [$this->paymentFactory->getMethodInstance($getScopeConfigPaymentMethod)];
                        }
                        break;
                    case 6:
                        $getScopeConfigProductCount = $this->scopeConfig->getValue('whosales_buyers/general/large_wholesale') ?? 0;
                        $itemsCount = $quote->getItemsCount();
                        if($itemsCount > $getScopeConfigProductCount){
                            $getScopeConfigPaymentMethod = $this->scopeConfig->getValue('whosales_buyers/general/large_avaliable_payment_method');
                            $methods = [$this->paymentFactory->getMethodInstance($getScopeConfigPaymentMethod)];
                        }
                        break;
                }
            }
        }

        return $methods;
    }
}
