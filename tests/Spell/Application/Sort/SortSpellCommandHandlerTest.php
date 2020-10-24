<?php

declare(strict_types = 1);

namespace Example\Tests\Spell\Application\Sort;

use Example\Spell\Application\Sort\SortSpellUseCase;
use Example\Spell\Domain\Bag;
use Example\Spell\Domain\Category;
use Example\Spell\Domain\Item;
use Example\Spell\Domain\User;
use PHPUnit\Framework\TestCase;

final class SortSpellCommandHandlerTest extends TestCase
{
    /** @test */
    public function moveItemsFromBackpacksToCategoryItemBag(): void
    {
        $herbsBag = new Bag(Category::createHerbs());
        $metalsBag = new Bag(Category::createMetals());
        $gold = new Item('gold', Category::createMetals());
        $durance = new User('durance');

        (new SortSpellUseCase())->__invoke($durance);

        $this->assertEmpty($durance->backpack()->items());

        $this->assertEmpty($herbsBag->items());
        $this->assertEquals([$gold], $metalsBag->items());
    }
}
