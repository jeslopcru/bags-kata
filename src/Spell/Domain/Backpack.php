<?php

declare(strict_types = 1);

namespace Example\Spell\Domain;

final class Backpack
{
    private const CAPACITY = 8;
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function items(): array
    {
        return $this->items;
    }

    /**
     * @throws FullCapacityExceeded
     */
    public function addItem(Item $item): void
    {
        if (count($this->items) >= self::CAPACITY) {
            throw new FullCapacityExceeded();
        }

        $this->items[] = $item;
    }
}
