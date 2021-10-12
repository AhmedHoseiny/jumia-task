<?php

namespace App\Repositories;

use App\Models\Customer;

/**
 * Class CustomerRepository
 * @package App\Repositories
 */
class CustomerRepository implements CustomerRepoInterface
{
    /**
     * @var Customer
     */
    private $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    /**
     * @param string $findBy
     * @return mixed
     */
    public function findBy(string $findBy): array
    {
        return $this->customer->select($findBy)->get()->toArray();
    }
}
