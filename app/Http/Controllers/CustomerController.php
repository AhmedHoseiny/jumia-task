<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;

/**
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller
{
    /**
     * @var CustomerService
     */
    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService(new CustomerRepository());
    }

    /**
     * @param CustomerRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getPhones(CustomerRequest $request)
    {
        $phones = $this->customerService->getPhones();

        $result = $this->customerService->extract($phones);

        if ($request->has('country', 'state')) {
            $filters = $request->all();
            $result = $this->customerService->filter($result, $filters);
        }

        return view('customer_phones', ['result' => $result]);
    }
}
