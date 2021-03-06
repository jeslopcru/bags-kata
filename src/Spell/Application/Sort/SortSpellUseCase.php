<?php

declare(strict_types = 1);

namespace Example\Spell\Application\Sort;

use Example\Spell\Domain\Category;
use Example\Spell\Domain\Item;
use Example\Spell\Domain\Luggage\Luggage;
use Example\Spell\Domain\User;

final class SortSpellUseCase
{
    /**
     * @var Item[]
     */
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function __invoke(User $user): void
    {
        $this->fillLuggage($user);
        $this->sortItems();
        $this->fillBagsWithCategorizedItems($user);
        $this->fillRestOfItems($user);
    }

    private function fillLuggage(User $user): void
    {
        $this->fill($user->backpack());
        foreach ($user->bags() as $bag) {
            $this->fill($bag);
        }
    }

    private function fill(Luggage $luggage): void
    {
        foreach ($luggage->items() as $item) {
            $this->items[] = $item;
            $luggage->setItems([]);
        }
    }

    private function sortItems(): void
    {
        usort(
            $this->items,
            function ($a, $b) {
                return $a->name() <=> $b->name();
            }
        );
    }

    private function getItemsForCategory(?Category $category, int $limit): array
    {
        $itemsOfCategory = [];
        $otherItems = [];

        foreach ($this->items as $item) {
            // @phpstan-ignore-next-line
            if (null !== $item->category() && $item->category()->equals($category) && count($itemsOfCategory) <= $limit) {
                $itemsOfCategory[] = $item;
            } else {
                $otherItems[] = $item;
            }
        }

        $this->items = $otherItems;

        return $itemsOfCategory;
    }

    private function fillBagsWithCategorizedItems(User $user): void
    {
        foreach ($user->bags() as $bag) {
            $bag->setItems($this->getItemsForCategory($bag->category(), 4));
        }
    }

    private function fillRestOfItems(User $user): void
    {
        foreach ($this->items as $item) {
            $user->pickUp($item);
        }
    }
}
