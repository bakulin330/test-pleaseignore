<?php

namespace classes;

use interfaces\ICustomerSource;
use PHPUnit\Framework\TestCase;

abstract class AbstractCustomerSourceTest extends TestCase
{
    /**
     * @var ICustomerSource
     */
    protected $instance;

    public function setUp(): void
    {
        $this->instance = $this->getCustomerSource();
    }

    /**
     * @return ICustomerSource
     */
    abstract protected function getCustomerSource(): ICustomerSource;

    /**
     * @covers ::getCustomers
     */
    public function testGetCustomers(): void
    {
        for ($i = 0; $i < 100; $i++) {
            foreach ($this->instance->getCustomers($i) as $customer) {
                self::assertInstanceOf(Customer::class, $customer);
            }
        }
    }
}

class TestCustomerSourceTest extends AbstractCustomerSourceTest
{

    /**
     * @return ICustomerSource
     */
    protected function getCustomerSource(): ICustomerSource
    {
        return new TestCustomerSource();
    }
}

class RandomCustomerSourceTest extends AbstractCustomerSourceTest
{

    /**
     * @return ICustomerSource
     */
    protected function getCustomerSource(): ICustomerSource
    {
        return new RandomCustomerSource();
    }
}
