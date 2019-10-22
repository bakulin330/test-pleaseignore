<?php


namespace interfaces;


use classes\Customer;

/**
 * Interface ICustomerSource
 * @package interfaces
 */
interface ICustomerSource
{

    /**
     * Список покупателей в данный момент времени
     *
     * @param int $tick
     *
     * @return Customer[]
     */
    public function getCustomers(int $tick): iterable;
}