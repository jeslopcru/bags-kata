<?php

declare(strict_types = 1);

namespace Example\Tests\Spell\Domain\Luggage;

use Example\Spell\Domain\Category;
use Example\Spell\Domain\Luggage\Bag;
use Example\Spell\Domain\Luggage\Exceptions\FullCapacityExceeded;
use Example\Tests\Spell\Domain\ItemMother;
use PHPUnit\Framework\TestCase;

final class BagTest extends TestCase
{
    /** @test */
    public function ByDefaultIsEmpty(): void
    {
        $bag = new Bag();

        $this->assertThat($bag->items(), $this->countOf(0));
    }

    /** @test */
    public function shouldAddAnItem(): void
    {
        $bag = new Bag();
        $item = ItemMother::random();
        $bag->addItem($item);

        $this->assertSame([$item], $bag->items());
    }

    /** @test */
    public function shouldHaveMaximumOf4Items(): void
    {
        $this->expectException(FullCapacityExceeded::class);
        $bag = new Bag();
        for ($i = 0; $i < 6; ++$i) {
            $bag->addItem(ItemMother::random());
        }
    }

    /** @test */
    public function couldHaveACategory(): void
    {
        $bag = new Bag(Category::createMetals());

        $this->assertInstanceOf(Category::class, $bag->category());
    }
}
