<?php

namespace classes;


use interfaces\ICustomer;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CashDeskManagerTest extends TestCase
{

    /**
     * @var ICustomer
     */
    private static $testCustomer;

    /**
     * @covers ::__constructor
     */
    public function test__constructException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new CashDeskManager(-1);
    }

    /**
     * @covers ::getCustomerCount
     *
     * @return CashDeskManager
     */
    public function testGetCustomerCountZero(): CashDeskManager
    {
        $manager = new CashDeskManager(Settings::getCashDeskCount());
        $this->assertEmpty($manager->getCustomerCount());

        return $manager;
    }

    /**
     * @depends testGetCustomerCountZero
     * @covers ::getOpenedCount
     *
     * @param CashDeskManager $manager
     *
     * @return CashDeskManager
     */
    public function testGetOpenedCountZero(CashDeskManager $manager): CashDeskManager
    {
        $this->assertEmpty($manager->getOpenedCount());

        return $manager;
    }

    /**
     * @depends testGetOpenedCountZero
     * @covers ::balanceCustomers
     * @covers ::getCustomerCount
     *
     * @param CashDeskManager $manager
     *
     * @return CashDeskManager
     */
    public function testBalanceCustomers(CashDeskManager $manager): CashDeskManager
    {
        self::$testCustomer = new Customer(1);
        $manager->balanceCustomers([self::$testCustomer]);
        $this->assertEquals(1, $manager->getCustomerCount());
        $manager->balanceCustomers([new Customer(1), new Customer(1), new Customer(1), new Customer(1), new Customer(1),]);
        $this->assertEquals(6, $manager->getCustomerCount());

        return $manager;
    }

    /**
     * @depends testBalanceCustomers
     * @covers ::getOpenedCount
     *
     * @param CashDeskManager $manager
     *
     * @return CashDeskManager
     */
    public function testGetOpenedCountNonZero(CashDeskManager $manager): CashDeskManager
    {
        $this->assertEquals(2, $manager->getOpenedCount());

        return $manager;
    }

    /**
     * @depends testGetOpenedCountNonZero
     * @covers ::tick
     *
     * @param CashDeskManager $manager
     *
     * @return CashDeskManager
     */
    public function testTick(CashDeskManager $manager): CashDeskManager
    {
        for ($i = 0; $i < self::$testCustomer->getTotalCheckoutTime() + self::$testCustomer->getPayTime(); $i++) {
            $manager->tick();
        }
        $this->assertEquals(4, $manager->getCustomerCount());

        return $manager;
    }

    /**
     * @depends testTick
     * @covers ::tick
     * @covers ::getOpenedCount
     *
     * @param CashDeskManager $manager
     */
    public function testTickClose(CashDeskManager $manager): void
    {
        for ($i = 0; $i < Settings::getTickToCloseCount(); $i++) {
            $manager->tick();
        }
        $this->assertEquals(1, $manager->getOpenedCount());
    }

}
