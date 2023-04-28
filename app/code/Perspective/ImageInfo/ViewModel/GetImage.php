<?php

namespace Perspective\ImageInfo\ViewModel;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Helper\Image;

class GetImage implements ArgumentInterface
{
    protected $imageHelper, $productFactory;
    public $product;

    public function __construct(Image $imageHelper, ProductFactory $productFactory)
    {
        $this->imageHelper = $imageHelper;
        $this->productFactory = $productFactory;
    }

    public function getImage(){
        if($this->product == null){
            return "please load product";
        }
        $url = $this->imageHelper->init($this->product, 'product_thumbnail_image');
        return $url;
    }

    public function  getProduct($id){
        try {
            $product = $this->productFactory->create()->load($id);
        } catch (NoSuchEntityException $entityException){
            return "Data not found";
        }
        $this->product = $product;
        return $this;
    }


}
