<?php

declare(strict_types = 1);

namespace Example\Spell\Domain;

final class Bag
{
    private array $items;
    private Category $category;

    public function __construct(Category $category)
    {
        $this->items = [];
        $this->category = $category;
    }

    public function items(): array
    {
        return $this->items;
    }
}
