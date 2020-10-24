<?php

declare(strict_types = 1);

namespace Example\Spell\Domain;

final class Backpack
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function items(): array
    {
        return $this->items;
    }
}
