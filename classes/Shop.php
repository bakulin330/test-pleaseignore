<?php


namespace classes;

use interfaces\ICustomerSource;

/**
 * Class Shop
 * @package classes
 */
class Shop
{
    /**
     * Источник покупателей
     * @var ICustomerSource
     */
    private $customerSource;
    /**
     * Менеджер касс
     * @var CashDeskManager
     */
    private $cashDeckManager;

    /**
     * Shop constructor.
     *
     * @param ICustomerSource $customerSource
     */
    public function __construct(ICustomerSource $customerSource)
    {
        $this->customerSource  = $customerSource;
        $this->cashDeckManager = new CashDeskManager(Settings::getCashDeskCount());
    }

    /**
     * Запуск магазина
     */
    public function run(): void
    {
        $tick   = 0;
        $closed = false;
        while (!$closed) {
            $this->cashDeckManager->tick();
            $this->cashDeckManager->balanceCustomers($this->customerSource->getCustomers($tick));
            //if (0 === $tick % 60){
            printf('Tick %d:' . PHP_EOL, $tick);
            $this->cashDeckManager->log();
            //}

            $closed = ($tick >= Settings::getMaxTickCount()) && ($this->cashDeckManager->getCustomerCount() === 0);
            $tick++;
        }
    }

}