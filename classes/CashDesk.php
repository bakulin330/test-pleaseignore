<?php

namespace classes;

use interfaces\ICustomer;

/**
 * Class CashDesk
 * @package classes
 */
class CashDesk
{
    /**
     * Очередь на кассе
     * @var array
     */
    private $queue = [];
    /**
     * Закрыта ли касса
     * @var bool
     */
    private $closed = true;
    /**
     * Количество времени без покупателей
     * @var int
     */
    private $idleCount = 0;

    /**
     * Закрыта ли касса
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->closed;
    }

    /**
     * Тик времени
     */
    public function tick(): void
    {
        if ($this->getQueueSize()) {
            $this->queue[0]--;
            if (!$this->queue[0]) {
                array_shift($this->queue);
            }
            $this->idleCount = 0;
        } else {
            $this->closeIfIdle();
        }
    }

    /**
     * Размер очереди на кассе
     * @return int
     */
    public function getQueueSize(): int
    {
        return count($this->queue);
    }

    /**
     *  Закрыть кассу, если никого нет определённое время
     */
    private function closeIfIdle(): void
    {
        $this->idleCount++;
        if ($this->idleCount >= Settings::getTickToCloseCount()) {
            $this->closed = true;
        }
    }

    /**
     * Добавить покупателя на кассу
     *
     * @param ICustomer $customer
     */
    public function addCustomer(ICustomer $customer): void
    {
        $this->queue[] = $customer->getTotalCheckoutTime() + $customer->getPayTime();
        $this->closed  = false;
    }

}
