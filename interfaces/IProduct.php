<?php


namespace interfaces;


/**
 * Interface IProduct
 * @package interfaces
 */
interface IProduct
{

    /**
     * Время пробивки продукта
     * @return int
     */
    public function getCheckoutTime(): int;

    /**
     * Наименование продукта
     * @return string
     */
    public function getName(): string;

    /**
     * Стоимость продукта
     * @return int
     */
    public function getCost(): int;
}