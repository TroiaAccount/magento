<?php

namespace Perspective\Customers\ViewModel;

use Magento\Customer\Model\Customer;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Customers implements ArgumentInterface
{

    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getAllCustomers(){
        return $this->customer->getCollection()->load();
    }

}
