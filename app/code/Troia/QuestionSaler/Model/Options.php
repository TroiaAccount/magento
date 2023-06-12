<?php

namespace Troia\QuestionSaler\Model;

class Options implements \Magento\Framework\Option\ArrayInterface
{

    const STATUS_PENDING = 0;
    const STATUS_SEND = 1;
    const STATUS_CLOSE = 2;


    public static function getOptionArray(){
        return [
            self::STATUS_PENDING => __('Pending'),
            self::STATUS_SEND => __('Send'),
            self::STATUS_CLOSE => __('Close')
        ];
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            self::STATUS_PENDING => __('Pending'),
            self::STATUS_SEND => __('Send'),
            self::STATUS_CLOSE => __('Close')
        ];
    }
}
