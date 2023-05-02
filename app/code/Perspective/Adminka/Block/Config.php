<?php
declare(strict_types=1);
namespace Perspective\Adminka\Block;

use Magento\Framework\View\Element\Template;
use Perspective\Adminka\Helper\Data;
use Magento\Framework\View\Element\Template\Context;

class Config extends Template
{
    protected $helper;

    public function __construct(Context $context, array $data = [], Data $helper)
    {
        $this->helper = $helper ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Perspective\Adminka\Helper\Data::class);
        parent::__construct($context, $data);
    }

    public function isEnabled(){
        return $this->helper->isEnabled();
    }

    public function getTitle(){
        return $this->helper->getTitle();
    }

    public function getSecret(){
        return $this->helper->getSecret();
    }

    public function getOption(){
        return $this->helper->getOption();
    }
}
