<?php

namespace unit\app\Services;

use App\Services\MercadoPagoService;
use MercadoPago\Customer;
use PHPUnit\Framework\TestCase;

class MercadoPagoServiceTest extends TestCase
{
    private MercadoPagoService $mercadoPagoService;

    private $mockSDK;

    public function testGetCustomerReturnsCustomerObject(): void
    {
        $email = 'test@example.com';

        $customer = $this->mercadoPagoService->getCustomer($email);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals($email, $customer->email);
    }

    public function testGetCustomerReturnsNullWhenCustomerNotFound()
    {
        $email = 'nonexistent@example.com';

        $customer = $this->mercadoPagoService->getCustomer($email);

        $this->assertNull($customer);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->mercadoPagoService = new MercadoPagoService();
    }
}
