<?php

declare(strict_types=1);

namespace Troia\ShippingMethodExample\Model\Carrier;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\Result;
use Magento\Shipping\Model\Rate\ResultFactory;
use Psr\Log\LoggerInterface;
use Magento\Customer\Model\Session;

class Customshipping extends AbstractCarrier implements CarrierInterface
{
    protected $_code = 'customshipping';

    protected $_isFixed = true;

    private ResultFactory $rateResultFactory;

    protected $customer;
    private MethodFactory $rateMethodFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        Session $session,
        array $data = []
    ) {
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
        $this->customer = $session ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Magento\Customer\Model\Session::class);
        $this->rateResultFactory = $rateResultFactory;
        $this->rateMethodFactory = $rateMethodFactory;
    }

    /**
     * Custom Shipping Rates Collector
     *
     * @param RateRequest $request
     * @return \Magento\Shipping\Model\Rate\Result|bool
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
        $customerDob = $this->customer->getCustomer()->getDob();
        $access = false;
        if($customerDob != null){
            $datetime = new \DateTime();
            $birthDay = new \DateTime($customerDob);
            $interval = $datetime->diff($birthDay);
            $years = $interval->y;
            if($years >= 60){
                $access = true;
            }
        }
        if(!$access){
            return false;
        }
        /** @var Method $method */
        $method = $this->rateMethodFactory->create();
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod($this->_code);
        $method->setMethodTitle($this->getConfigData('name'));

        $shippingCost = (float) $this->getConfigData('shipping_cost');
        $countItems = count($request->getAllItems());
        if($countItems <= 10){
            $countItems = $countItems * 10;
        } else {
            $countItems = 100;
        }

        $shippingCost = $shippingCost - (($shippingCost * $countItems) / 100);

        $method->setPrice($shippingCost);
        $method->setCost($shippingCost);

        /** @var Result $result */
        $result = $this->rateResultFactory->create();
        $result->append($method);

        return $result;
    }

    public function getAllowedMethods(): array
    {
        return [$this->_code => $this->getConfigData('name')];
    }
}
