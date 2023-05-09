<?php
namespace Troia\DemoPlugin\Plugins\Catalog\Model;
class Product
{
    public function afterGetName(\Magento\Catalog\Model\Product $product, $name)
    {
        $price = $product->getData('price');
        if ($price < 60) {
            $name .= " So cheap";
        }
        else {
            $name .= " So expensive";
        }
        return $name;
    }
}
