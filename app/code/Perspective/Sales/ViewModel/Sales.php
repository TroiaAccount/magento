<?php

namespace Perspective\Sales\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Perspective\Sales\Model\ResourceModel\SalesTable\Collection as SalesTableCollection;

class Sales implements ArgumentInterface
{
    protected $salesTableCollection;
    public function __construct(SalesTableCollection $salesTableCollection)
    {
        $this->salesTableCollection = $salesTableCollection;
    }

    public function getSalesByFilter($product_name, $today){
        $result = [];
        $products = $this->salesTableCollection->addFilter('name', $product_name)->getItems();

        foreach ($products as  $product){
            $price = $product->getPrice() * $product->getQuantity();
            $dateObject = new \DateTime($product->getDate());
            $dateOnly = $dateObject->format('Y-m-d');
            $discount = 0;
            if($dateOnly == $today){
                $price = $price - (($price * $product->getDiscount()) / 100);
                $discount = $product->getDiscount();
            }
            $result[] = ['price' => $product->getPrice() * $product->getQuantity(), 'total_price' => $price, 'name' => $product->getName(), 'date' => $dateOnly, 'discount' => $discount];
        }
        return $result;
    }

}
