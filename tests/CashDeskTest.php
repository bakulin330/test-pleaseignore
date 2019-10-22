<?php

namespace classes;


use interfaces\ICustomer;
use PHPUnit\Framework\TestCase;

class CashDeskTest extends TestCase
{
    /**
     * @var ICustomer
     */
    private static $testCustomer;

    /**
     * @covers ::getQueueSize
     *
     * @return CashDesk
     */
    public function testGetQueueSize(): CashDesk
    {
        $cashDesk = new CashDesk();
        $this->assertEmpty($cashDesk->getQueueSize());

        return $cashDesk;
    }

    /**
     * @depends testGetQueueSize
     * @covers ::addCustomer
     *
     * @param CashDesk $cashDesk
     *
     * @return CashDesk
     */
    public function testAddCustomer(CashDesk $cashDesk): CashDesk
    {
        self::$testCustomer = new Customer(1);
        $cashDesk->addCustomer(self::$testCustomer);
        $this->assertEquals(1, $cashDesk->getQueueSize());

        return $cashDesk;
    }

    /**
     * @depends testAddCustomer
     * @covers ::tick
     *
     * @param CashDesk $cashDesk
     *
     * @return CashDesk
     */
    public function testTickCheckoutPay(CashDesk $cashDesk): CashDesk
    {
        for ($i = 0; $i < self::$testCustomer->getTotalCheckoutTime() + self::$testCustomer->getPayTime(); $i++) {
            $cashDesk->tick();
        }
        $this->assertEquals(0, $cashDesk->getQueueSize());

        return $cashDesk;
    }

    /**
     * @depends testTickCheckoutPay
     * @covers ::isClosed
     *
     * @param CashDesk $cashDesk
     *
     * @return CashDesk
     */
    public function testIsOpened(CashDesk $cashDesk): CashDesk
    {
        $this->assertFalse($cashDesk->isClosed());

        return $cashDesk;
    }

    /**
     * @depends testIsOpened
     * @covers ::tick
     *
     * @param CashDesk $cashDesk
     *
     * @return CashDesk
     */
    public function testTickClose(CashDesk $cashDesk): CashDesk
    {
        for ($i = 0; $i < Settings::getTickToCloseCount(); $i++) {
            $cashDesk->tick();
        }
        $this->assertEquals(0, $cashDesk->getQueueSize());

        return $cashDesk;
    }

    /**
     * @depends testTickClose
     * @covers ::isClosed
     *
     * @param CashDesk $cashDesk
     */
    public function testIsClosed(CashDesk $cashDesk): void
    {
        $this->assertTrue($cashDesk->isClosed());
    }

}
