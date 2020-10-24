<?php

declare(strict_types = 1);

namespace Example\Tests\Spell\Domain;

use Example\Spell\Domain\Category;
use Example\Spell\Domain\Item;

final class ItemMother
{
    public static function random(): Item
    {
        return new Item('gold', Category::createMetals());
    }
}
