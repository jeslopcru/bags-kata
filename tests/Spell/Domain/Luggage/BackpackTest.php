<?php

declare(strict_types = 1);

namespace Example\Tests\Spell\Domain\Luggage;

use Example\Spell\Domain\Luggage\Backpack;
use Example\Spell\Domain\Luggage\Exceptions\FullCapacityExceeded;
use Example\Tests\Spell\Domain\ItemMother;
use PHPUnit\Framework\TestCase;

final class BackpackTest extends TestCase
{
    /** @test */
    public function ByDefaultIsEmpty(): void
    {
        $backpack = new Backpack();

        $this->assertThat($backpack->items(), $this->countOf(0));
    }

    /** @test */
    public function shouldAddAnItem(): void
    {
        $backpack = new Backpack();
        $item = ItemMother::random();
        $backpack->addItem($item);

        $this->assertSame([$item], $backpack->items());
    }

    /** @test */
    public function shouldHaveMaximumOf8Items(): void
    {
        $this->expectException(FullCapacityExceeded::class);
        $backpack = new Backpack();
        for ($i = 0; $i < 10; ++$i) {
            $item = ItemMother::random();
            $backpack->addItem($item);
        }
    }
}
