<?php

declare(strict_types = 1);

namespace Example\Spell\Domain;

final class Bag
{
    private const CAPACITY = 4;
    private array $items;
    private ?Category $category;

    public function __construct(Category $category = null)
    {
        $this->items = [];
        $this->category = $category;
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

    public function category(): ?Category
    {
        return $this->category;
    }
}
