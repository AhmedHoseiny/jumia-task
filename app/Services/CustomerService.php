<?php

namespace App\Services;

use App\Repositories\CustomerRepoInterface;
use App\Repositories\CustomerRepository;
use App\Traits\CustomerPhoneParsableTrait;

/**
 * Class CustomerService
 * @package App\Services
 */
class CustomerService
{
    use CustomerPhoneParsableTrait;

    /**
     * @var CustomerRepository
     */
    private $customerRepo;

    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $countriesConfig;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepo
     */
    public function __construct(CustomerRepoInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;

        $this->countriesConfig = config('country_code_regex');
    }

    /**
     * @return mixed
     */
    public function getPhones()
    {
        return $this->customerRepo->findBy('phone');
    }

    /**
     * @param $phones
     * @return array
     */
    public function extract($phones): array
    {
        return $this->parse($phones);
    }

    /**
     * @param array $result
     * @param array $filters
     * @return array
     */
    public function filter(array $result, array $filters): array
    {
        $filtered = $result;

        foreach($filters as $key => $filter)
        {
            $filtered = array_filter($filtered, function($v, $k) use ($key, $filter) {
                return $v[$key] == $filter;
            }, ARRAY_FILTER_USE_BOTH);
        }

        return $filtered;
    }
}
