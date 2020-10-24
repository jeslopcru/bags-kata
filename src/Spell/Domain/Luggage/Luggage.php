<?php

declare(strict_types = 1);

namespace Example\Spell\Domain\Luggage;

use Example\Spell\Domain\Item;
use Example\Spell\Domain\Luggage\Exceptions\FullCapacityExceeded;

abstract class Luggage
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @throws FullCapacityExceeded
     */
    public function addItem(Item $item): void
    {
        if (count($this->items) >= $this->capacity()) {
            throw new FullCapacityExceeded();
        }

        $this->items[] = $item;
    }

    abstract protected function capacity(): int;

    public function items(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }
}
