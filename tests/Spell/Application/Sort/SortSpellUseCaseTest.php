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

    /** @test */
    public function shouldSaveItemInTheBackpackIfItemNotBelongToABag(): void
    {
        $user = new User('durance');
        $bag = new Bag(Category::createHerbs());
        $iron = new Item('gold', Category::createMetals());
        $user->pickUp($iron);

        (new SortSpellUseCase())->__invoke($user);

        $this->assertEmpty($bag->items());
        $this->assertEquals([$iron], $user->backpack()->items());
    }

    /** @test */
    public function ShouldBeOrderAlphabetically(): void
    {
        $gold = new Item('gold', Category::createMetals());
        $copper = new Item('copper', Category::createMetals());
        $cherryBlossom = new Item('cherry blossom', Category::createHerbs());
        $seaweed = new Item('seaweed', Category::createHerbs());
        $metalBag = new Bag(Category::createMetals());
        $user = new User('durance');
        $user->addBag($metalBag);
        $user->pickUp($gold);
        $user->pickUp($copper);
        $user->pickUp($cherryBlossom);
        $user->pickUp($seaweed);

        (new SortSpellUseCase())->__invoke($user);

        $this->assertEquals([$copper, $gold], $metalBag->items());
        $this->assertEquals([$cherryBlossom, $seaweed], $user->backpack()->items());
    }
}
