<?php


namespace classes;


use interfaces\ICustomerSource;

/**
 * Class TestCustomerSource
 * @package classes
 */
class TestCustomerSource implements ICustomerSource
{
    /**
     * @var Customer[]
     */
    private $customers;

    /**
     * TestCustomerSource constructor.
     */
    public function __construct()
    {
        $this->customers = [
            1 => [new Customer(10)],
            2 => [new Customer(1), new Customer(1), new Customer(1), new Customer(1), new Customer(1)],
            3 => [new Customer(1), new Customer(1), new Customer(1),],
            4 => [new Customer(1), new Customer(1), new Customer(1),],
        ];
    }

    /**
     * Список покупателей в данный момент времени
     *
     * @param int $tick
     *
     * @return Customer[]
     */
    public function getCustomers(int $tick): iterable
    {
        return $this->customers[$tick] ?? [];
    }
}