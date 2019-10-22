<?php


namespace interfaces;


/**
 * Interface ISettings
 * @package interfaces
 */
interface ISettings
{
    /**
     * Время пробивки продукта
     * @return int
     */
    public static function getProductCheckoutTime(): int;

    /**
     * Время оплаты покупки
     * @return int
     */
    public static function getPayTime(): int;

    /**
     * Максимальный размер очереди на кассе, предже чем открыть новую
     * @return int
     */
    public static function getQueueThreshold(): int;

    /**
     * Колчичество касс
     * @return int
     */
    public static function getCashDeskCount(): int;

    /**
     * Максимальное время работы магазина
     * @return int
     */
    public static function getMaxTickCount(): int;

    /**
     * Количество времени до закрытия кассы, если никого нет в очереди
     * @return int
     */
    public static function getTickToCloseCount(): int;

    /**
     * Максимальное количество покупок у одного человека
     * @return int
     */
    public static function getDefaultMaxItems(): int;

}