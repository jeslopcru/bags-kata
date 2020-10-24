<?php

declare(strict_types = 1);

namespace Example\Tests\Spell\Application\Sort;

use Example\Spell\Application\Sort\SortSpellUseCase;
use Example\Spell\Domain\Category;
use Example\Spell\Domain\Item;
use Example\Spell\Domain\Luggage\Bag;
use Example\Spell\Domain\User;
use PHPUnit\Framework\TestCase;

final class SortSpellUseCaseTest extends TestCase
{
    /** @test */
    public function moveItemsFromBackpacksToCategoryItemBag(): void
    {
        $herbsBag = new Bag(Category::createHerbs());
        $metalsBag = new Bag(Category::createMetals());
        $gold = new Item('gold', Category::createMetals());
        $user = new User('durance');
        $user->addBag($herbsBag);
        $user->addBag($metalsBag);

        $user->pickUp($gold);

        (new SortSpellUseCase())->__invoke($user);

        $this->assertCount(0, $user->backpack()->items());

        $this->assertEmpty($herbsBag->items());
        $this->assertEquals([$gold], $metalsBag->items());
    }
}
