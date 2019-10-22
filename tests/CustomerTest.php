<?php

namespace classes;


use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{

    /**
     * @covers ::__construct
     */
    public function test__construct(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Customer(-1);
    }

    /**
     * @covers ::getItemCount
     */
    public function testGetItemCount(): void
    {
        $customer = new Customer(10);
        $this->assertEquals(10, $customer->getItemCount());
    }

}
