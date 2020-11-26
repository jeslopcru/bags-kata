<?php

declare(strict_types = 1);

namespace Example\Tests\Spell\Domain;

use Example\Spell\Domain\Category;
use Example\Spell\Domain\Item;
use Example\Spell\Domain\Luggage\Bag;
use Example\Spell\Domain\Luggage\Exceptions\NoSpaceAvailableException;
use Example\Spell\Domain\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    /** @test */
    public function ByDefaultHaveAEmptyBackpack(): void
    {
        $user = new User('aUser');

        $this->assertThat($user->backpack()->items(), $this->countOf(0));
    }

    /** @test */
    public function CouldHaveABag(): void
    {
        $user = new User('aUser');
        $bag = new Bag();
        $user->addBag($bag);

        $this->assertEquals([$bag], $user->bags());
    }

    /** @test */
    public function shouldHaveMaximumOf4Bags(): void
    {
        $user = new User('aUser');
        for ($i = 0; $i < 4; $i++) {
            $user->addBag(new Bag());
        }
        $this->assertCount(4,$user->bags());

        $this->expectException(MaxBagsExceed::class);
        $user->addBag(new Bag());
    }

    /** @test */
    public function shouldPickUpAnItemByDefaultToBackpack(): void
    {
        $user = new User('aUser');

        $user->pickUp(ItemMother::random());

        $this->assertEquals([ItemMother::random()], $user->backpack()->items());
    }

    /** @test */
    public function shouldSaveItemsInABagIfBackpackIsFull(): void
    {
        $user = new User('aUser');
        $aBag = new Bag();
        $user->addBag($aBag);

        $this->fullBackpack($user);
        $item = new Item('Rose', Category::createHerbs());
        $user->pickUp($item);

        $this->assertCount(8, $user->backpack()->items());
        $this->assertCount(1, $user->bags());
        $this->assertEquals([$item], $aBag->items());
    }

    /** @test */
    public function shouldSaveItemsInOtherBagIfaBagIsFull(): void
    {
        $user = new User('aUser');
        $aBag = new Bag();
        $user->addBag(new Bag());
        $user->addBag($aBag);

        $this->fullBackpack($user);
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
        $item = new Item('Rose', Category::createHerbs());
        $user->pickUp($item);

        $this->assertCount(8, $user->backpack()->items());
        $this->assertCount(2, $user->bags());
        $this->assertEquals([$item], $aBag->items());
    }

    /** @test */
    public function shouldExceptionWhenNoSpaceAvailable(): void
    {
        $user = new User('aUser');

        $this->fullBackpack($user);
        $this->expectException(NoSpaceAvailableException::class);

        $user->pickUp(ItemMother::random());
    }

    private function fullBackpack(User $user): void
    {
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
        $user->pickUp(ItemMother::random());
    }
}
