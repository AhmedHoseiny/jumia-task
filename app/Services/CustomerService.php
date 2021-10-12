<?php

namespace App\Services;

use App\Repositories\CustomerRepository;

/**
 * Class CustomerService
 * @package App\Services
 */
class CustomerService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepo;

    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $countriesValidation;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepo
     */
    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepo = $customerRepo;

        $this->countriesValidation = config('country_code_regex');
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
    public function parseData($phones): array
    {
        $parsed = [];

        foreach ($phones as $key => $value)
        {
            $phoneArray = explode(' ', $value['phone']);

            $parsed[$key]['country'] = $this->getCountry($value['phone']);
            $parsed[$key]['state'] = $this->getState($value['phone']);
            $parsed[$key]['code'] = $this->getCode($value['phone']);
            $parsed[$key]['number'] = end($phoneArray);
        }

        return $parsed;
    }

    /**
     * @param $value
     * @return string
     */
    public function getCountry($value): string
    {
        $country = '';

        foreach ($this->countriesValidation as $key => $validator)
        {
            preg_match('/' . substr($validator['regex'], 0, 10) . '/', $value, $matches);

            if (sizeof($matches) > 0) {
                $country = $key;
            }
        }

        return $country;
    }

    /**
     * @param $value
     * @return bool
     */
    public function getState($value): bool
    {
        $valid = false;

        foreach ($this->countriesValidation as $validator)
        {
            preg_match('/' . $validator['regex'] . '/', $value, $matches);

            if (sizeof($matches) > 0) {
                $valid = true;
            }
        }

        return $valid;
    }

    /**
     * @param $value
     * @return string
     */
    public function getCode($value): string
    {
        $code = '';

        foreach ($this->countriesValidation as $validator)
        {
            preg_match('/' . substr($validator['regex'], 0, 10) . '/', $value, $matches);

            if (sizeof($matches) > 0) {
                $code = $validator['code'];
            }
        }

        return $code;
    }

    /**
     * @param array $result
     * @param array $filters
     * @return array
     */
    public function filterData(array $result, array $filters): array
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
