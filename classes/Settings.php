<?php


namespace classes;


use interfaces\ISettings;

class Settings implements ISettings
{
    /**
     * @var int Время пробивки продукта
     */
    private const PRODUCT_CHECKOUT_TIME = 1;
    /**
     * @var int Время оплаты покупки
     */
    private const PAY_TIME = 2;
    /**
     * @var int Максимальный размер очереди на кассе, предже чем открыть новую
     */
    private const QUEUE_THRESHOLD = 5;
    /**
     * @var int Колчичество касс
     */
    private const CASH_DESK_COUNT = 2;
    /**
     * @var int Максимальное время работы магазина
     */
    private const MAX_TICK_COUNT = 20;
    /**
     * @var int Количество времени до закрытия кассы, если никого нет в очереди
     */
    private const TICK_TO_CLOSE = 5;
    /**
     * @var int Максимальное количество покупок у одного человека
     */
    private const DEFAULT_MAX_ITEMS = 10;


    /**
     * Время пробивки продукта
     * @return int
     */
    public static function getProductCheckoutTime(): int
    {
        return self::PRODUCT_CHECKOUT_TIME;
    }

    /**
     * Время оплаты покупки
     * @return int
     */
    public static function getPayTime(): int
    {
        return self::PAY_TIME;
    }

    /**
     * Максимальный размер очереди на кассе, предже чем открыть новую
     * @return int
     */
    public static function getQueueThreshold(): int
    {
        return self::QUEUE_THRESHOLD;
    }

    /**
     * Колчичество касс
     * @return int
     */
    public static function getCashDeskCount(): int
    {
        return self::CASH_DESK_COUNT;
    }

    /**
     * Максимальное время работы магазина
     * @return int
     */
    public static function getMaxTickCount(): int
    {
        return self::MAX_TICK_COUNT;
    }

    /**
     * Количество времени до закрытия кассы, если никого нет в очереди
     * @return int
     */
    public static function getTickToCloseCount(): int
    {
        return self::TICK_TO_CLOSE;
    }

    /**
     * Максимальное количество покупок у одного человека
     * @return int
     */
    public static function getDefaultMaxItems(): int
    {
        return self::DEFAULT_MAX_ITEMS;
    }
}