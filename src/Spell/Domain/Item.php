<?php

declare(strict_types = 1);

namespace Example\Spell\Domain;

final class Item
{
    private string $name;
    private Category $category;

    public function __construct(string $name, Category $category)
    {
        $this->name = $name;
        $this->category = $category;
    }
}
