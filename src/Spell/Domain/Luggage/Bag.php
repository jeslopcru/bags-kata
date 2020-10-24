<?php

declare(strict_types = 1);

namespace Example\Spell\Domain\Luggage;

use Example\Spell\Domain\Category;

final class Bag extends Luggage
{
    protected array $items;
    private ?Category $category;

    public function __construct(Category $category = null)
    {
        parent::__construct();
        $this->category = $category;
    }

    public function category(): ?Category
    {
        return $this->category;
    }

    protected function capacity(): int
    {
        return 4;
    }
}
