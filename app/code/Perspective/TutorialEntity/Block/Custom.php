<?php

namespace Perspective\TutorialEntity\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;

class Custom extends \Magento\Catalog\Block\Product\View
{
    protected $helper;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        array $data = [],
        \Perspective\TutorialEntity\Helper\Custom $customHelper = null
    )
    {
        $this->helper = $customHelper ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Perspective\TutorialEntity\Helper\Custom::class);
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
    }

    public  function getAnyCustomValue(){
        $product = $this->getProduct();
        $str = "Any value: " . $product->getFinalPrice();
        return $str;
    }

    public function isAvaliable(){
        return $this->helper->validateProductBySku($this->getProduct()->getSku());
    }
}
