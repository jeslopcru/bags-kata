<?php

declare(strict_types = 1);

namespace Example\Spell\Domain;

final class Category
{
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function createHerbs(): self
    {
        return new self('HERBS');
    }

    public static function createMetals(): self
    {
        return new self('METALS');
    }
}
