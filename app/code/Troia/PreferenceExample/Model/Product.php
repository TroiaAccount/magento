<?php
    namespace Troia\PreferenceExample\Model;

    class Product extends \Magento\Catalog\Model\Product
    {
        public function getName()
        {
            return "Preference Demo";
        }
    }
