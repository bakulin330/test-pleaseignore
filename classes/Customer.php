<?php


namespace classes;

use interfaces\ICustomer;

/**
 * Class Customer
 * @package classes
 */
class Customer implements ICustomer
{
    /**
     * Количество покупок
     * @var int
     */
    private $itemCount;

    /**
     * @var Product[]
     */
    private $items;

    /**
     * Customer constructor.
     *
     * @param int|null $itemCount
     */
    public function __construct(?int $itemCount = null)
    {
        if ($itemCount && $itemCount < 1) {
            throw new \InvalidArgumentException('Items count should be positive');
        }
        $this->itemCount = $itemCount ?? mt_rand(1, Settings::getDefaultMaxItems());
        for ($i = 0; $i < $this->itemCount; $i++) {
            $this->items[] = new Product();
        }
    }

    /**
     * Возвращает количество покупок
     * @return int
     */
    public function getItemCount(): int
    {
        return $this->itemCount;
    }

    /**
     * Возвращает общее время пробивки всех товаров
     * @return int
     */
    public function getTotalCheckoutTime(): int
    {
        $time = 0;
        foreach ($this->items as $item) {
            $time += $item->getCheckoutTime();
        }

        return $time;
    }

    /**
     * Возвращает время оплаты
     * @return int
     */
    public function getPayTime(): int
    {
        return Settings::getPayTime();
    }

}