<?php

namespace Perspective\TestGridUi\Model;

class Status implements \Magento\Framework\Option\ArrayInterface
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;


    public static function getOptionArray(){
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled')
        ];
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled')
        ];
    }
}
