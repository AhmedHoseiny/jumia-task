<?php

namespace App\Repositories;

use App\Models\Customer;

/**
 * Class CustomerRepository
 * @package App\Repositories
 */
class CustomerRepository
{
    /**
     * @var Customer
     */
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param string $findBy
     * @return mixed
     */
    public function findBy(string $findBy)
    {
        return $this->customer->select($findBy)->get()->toArray();
    }
}
