<?php


namespace classes;

use interfaces\ICustomer;

/**
 * Class CashDeskManager
 * @package classes
 */
class CashDeskManager
{
    /**
     * Массив касс
     * @var CashDesk[]
     */
    private $cashDesks = [];

    /**
     * CashDeskManager constructor.
     *
     * @param int $cashDesksCount
     */
    public function __construct(int $cashDesksCount)
    {
        if ($cashDesksCount < 1) {
            throw new \InvalidArgumentException('Cash desks count should be positive');
        }
        for ($i = 0; $i < $cashDesksCount; $i++) {
            $this->cashDesks[] = new CashDesk();
        }
    }

    /**
     * Тик времени
     */
    public function tick(): void
    {
        foreach ($this->cashDesks as $cashDesk) {
            $cashDesk->tick();
        }
    }

    /**
     * Общее количество покупателей на всех кассах
     * @return int
     */
    public function getCustomerCount(): int
    {
        $count = 0;
        foreach ($this->cashDesks as $cashDesk) {
            $count += $cashDesk->getQueueSize();
        }

        return $count;
    }

    /**
     * Количество открытых касс
     * @return int
     */
    public function getOpenedCount(): int
    {
        $open = 0;
        foreach ($this->cashDesks as $cashDesk) {
            if (!$cashDesk->isClosed()) {
                $open++;
            }
        }

        return $open;
    }

    /**
     * Распределить покупателей по кассам
     *
     * @param ICustomer[]|iterable $customers
     */
    public function balanceCustomers($customers): void
    {
        foreach ($customers as $customer) {
            $cd = $this->getCashDeskWithMinimumQueue();
            if (!$cd) {
                $this->cashDesks[0]->addCustomer($customer);
            } else if ($cd->getQueueSize() >= Settings::getQueueThreshold()) {
                $closed = $this->getClosedCashDesk();
                if ($closed) {
                    $closed->addCustomer($customer);
                } else {
                    $cd->addCustomer($customer);
                }
            } else {
                $cd->addCustomer($customer);
            }
        }
    }

    /**
     * Получить кассу с наименьшей очередью
     * @return CashDesk|null
     */
    private function getCashDeskWithMinimumQueue(): ?CashDesk
    {
        $index   = -1;
        $minimum = PHP_INT_MAX;
        foreach ($this->cashDesks as $key => $cashDesk) {
            if ($cashDesk->getQueueSize() < $minimum && !$cashDesk->isClosed()) {
                $minimum = $cashDesk->getQueueSize();
                $index   = $key;
            }
        }
        if (-1 === $index) {
            return null;
        }

        return $this->cashDesks[$index];
    }

    /**
     * Получить закрытую кассу
     * @return CashDesk|null
     */
    private function getClosedCashDesk(): ?CashDesk
    {
        $index = -1;
        foreach ($this->cashDesks as $key => $cashDesk) {
            if ($cashDesk->isClosed()) {
                $index = $key;
                break;
            }
        }
        if (-1 === $index) {
            return null;
        }

        return $this->cashDesks[$index];
    }

    /**
     * Вывод на экран
     */
    public function log(): void
    {
        $open = 0;
        foreach ($this->cashDesks as $key => $cashDesk) {
            if (!$cashDesk->isClosed()) {
                $open++;
            }
            printf('Cash desk %d queue size: %d' . PHP_EOL, $key + 1, $cashDesk->getQueueSize());
        }
        printf('Total open cash desks: %d' . PHP_EOL, $open);
    }
}