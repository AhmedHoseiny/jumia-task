<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\CustomerService;
use Tests\TestCase;

/**
 * Class CustomerPhoneTest
 * @package Tests\Unit
 */
class CustomerPhoneTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $countriesValidation;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->countriesValidation = config('country_code_regex');

        Customer::factory()->count(5)->create();

        app()->bind('customerRepo', function () {
            return new CustomerRepository(new Customer());
        });

        $customerRepo = app('customerRepo');

        $this->customerService = new CustomerService($customerRepo);
    }

    public function test_it_returns_all_customers()
    {
        $phones = $this->customerService->getPhones();

        $this->assertEquals(sizeof($phones), 5);
    }

    public function test_it_returns_country_from_phone()
    {
        $phone = Customer::factory()->create(['phone' => '(212) 6007989253']);

        $countries = array_keys($this->countriesValidation);

        $country = $this->customerService->getCountry($phone);

        $this->assertEquals($country, $countries[2]);
    }

    public function test_it_returns_state_of_phone_valid_or_not()
    {
        $phone = Customer::factory()->create(['phone' => '(212) 6007989253']);

        $state = $this->customerService->getState($phone);

        $this->assertEquals($state, false);
    }

    public function test_it_returns_country_code_from_phone()
    {
        $phone = Customer::factory()->create(['phone' => '(212) 6007989253']);

        $countries = array_values($this->countriesValidation);

        $countryCode = $this->customerService->getCode($phone);

        $this->assertEquals($countryCode, $countries[2]['code']);
    }
}
