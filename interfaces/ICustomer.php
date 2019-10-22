<?php


namespace interfaces;


/**
 * Interface ICustomer
 * @package interfaces
 */
interface ICustomer
{
    /**
     * Возвращает количество покупок
     * @return int
     */
    public function getItemCount(): int;

    /**
     * Возвращает общее время пробивки всех товаров
     * @return int
     */
    public function getTotalCheckoutTime(): int;

    /**
     * Возвращает время оплаты
     * @return int
     */
    public function getPayTime(): int;

}