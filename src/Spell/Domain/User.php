<?php

declare(strict_types = 1);

namespace Example\Spell\Domain;

use Example\Spell\Domain\Luggage\Backpack;

final class User
{
    private string $userId;
    private Backpack $backpack;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
        $this->backpack = new Backpack();
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function backpack(): Backpack
    {
        return $this->backpack;
    }
}
