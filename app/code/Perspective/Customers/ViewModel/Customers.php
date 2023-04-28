<?php

namespace Perspective\Customers\ViewModel;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Group;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Customers implements ArgumentInterface
{

    protected $customer, $group;

    public function __construct(Customer $customer, Group $group)
    {
        $this->customer = $customer;
        $this->group = $group;
    }

    public function getAllCustomers(){
        return $this->customer->getCollection()->load();
    }

    public  function getCustomerGroups(){
        return $this->group->getCollection()->load();
    }

}
