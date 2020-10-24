<?php

declare(strict_types = 1);

namespace Example\Spell\Domain\Luggage;

final class Backpack extends Luggage
{
    protected function capacity(): int
    {
        return 8;
    }
}
