<?php

declare(strict_types = 1);

namespace Example\Spell\Domain;

use Example\Spell\Domain\Luggage\Backpack;
use Example\Spell\Domain\Luggage\Bag;
use Example\Tests\Spell\Domain\MaxBagsExceed;

final class User
{
    private const MAX_BAGS = 4;
    private string $userId;
    private Backpack $backpack;
    /** @var array Bag[] */
    private array $bags;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
        $this->backpack = new Backpack();
        $this->bags = [];
    }

    public function userId(): string
    {
        return $this->userId;
    }

    /**
     * @return Bag[]
     */
    public function bags(): array
    {
        return $this->bags;
    }

    /**
     * @throws MaxBagsExceed
     */
    public function addBag(Bag $bag): void
    {
        if (count($this->bags) >= self::MAX_BAGS) {
            throw new MaxBagsExceed();
        }
        $this->bags[] = $bag;
    }

    public function pickUp(Item $item): void
    {
        try {
            $this->backpack()->addItem($item);
        } catch (Luggage\Exceptions\FullCapacityExceeded $e) {
            foreach ($this->bags() as $bag) {
                try {
                    $bag->addItem($item);

                    return;
                } catch (Luggage\Exceptions\FullCapacityExceeded $e) {
                }
            }
        }
    }

    public function backpack(): Backpack
    {
        return $this->backpack;
    }
}
