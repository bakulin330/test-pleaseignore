<?php


namespace classes;


use interfaces\IProduct;

/**
 * Class Product
 * @package classes
 */
class Product implements IProduct
{
    /**
     * Цена
     * @var int
     */
    private $price;
    /**
     * Наименование
     * @var string
     */
    private $name;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->price = mt_rand(100, 10000);
        $this->name  = 'Продукт с ценой ' . $this->price;
    }

    /**
     * Время пробивки продукта
     * @return int
     */
    public function getCheckoutTime(): int
    {
        return Settings::getProductCheckoutTime();
    }

    /**
     * Наименование продукта
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Стоимость продукта
     * @return int
     */
    public function getCost(): int
    {
        return $this->price;
    }
}