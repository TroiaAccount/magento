<?php


namespace Troia\CronDiscount\Cron;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\CatalogRule\Model\RuleFactory as CatalogPriceRule;


class EnableDiscount
{

    protected $scopeConfig, $catalogPriceRule;

    public function __construct(ScopeConfigInterface $scopeConfig, CatalogPriceRule $catalogPriceRule)
    {
        $this->scopeConfig = $scopeConfig;
        $this->catalogPriceRule = $catalogPriceRule;
    }

    public function enable()
    {

        $catalogRule = $this->catalogPriceRule->create()->load(2);
        $catalogRule->setIsActive(true);
        $catalogRule->save();
    }

    public function disable()
    {
        $catalogRule = $this->catalogPriceRule->create()->load(2);
        $catalogRule->setIsActive(false);
        $catalogRule->save();
    }
}
