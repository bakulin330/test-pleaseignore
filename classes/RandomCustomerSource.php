<?php


namespace classes;


use interfaces\ICustomerSource;

/**
 * Class RandomCustomerSource
 * @package classes
 */
class RandomCustomerSource implements ICustomerSource
{

    /**
     * Случайная генерация покупателей
     * @param int $tick
     *
     * @return Customer[]
     */
    public function getCustomers(int $tick): iterable
    {
        if (0 === mt_rand(0, 5)) {
            return [new Customer()];
        }

        return [];
    }
}