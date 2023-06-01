<?php


namespace Troia\CronDiscount\Cron;

use Magento\Config\Model\ResourceModel\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;

class EnableDiscount
{

    protected $config, $scopeConfig, $configCache;

    public function __construct(Config $config, ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        $this->config = $config;
    }

    /**
     * Cronjob Description
     *
     * @return void
     */
    public function start(): void
    {
        $start = $this->scopeConfig->getValue('cron_discount/general/start');
        $end = $this->scopeConfig->getValue('cron_discount/general/end');
        $now = date('H', time());
        if($now >= $start && $now <= $end){
            $this->config->saveConfig('cron_discount/general/enable', 1);
        } else {
            $this->config->saveConfig('cron_discount/general/enable', 0);
        }
    }
}
