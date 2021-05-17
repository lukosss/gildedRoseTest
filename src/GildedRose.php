<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ItemTypes\AgedBrie;
use GildedRose\ItemTypes\BackstageTicket;
use GildedRose\ItemTypes\Common;
use GildedRose\ItemTypes\Conjured;
use GildedRose\ItemTypes\Sulfuras;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Just for testing purposes
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Check if item name contains which type of item it is
     * @param string $name
     * @param string $type
     * @return bool
     */
    public function checkItemType(string $name, string $type): bool
    {
        return str_contains(ucfirst($name), $type);
    }

    /**
     * Calls the specific item type Class through interface implementation and runs updateItemQuality method
     * @param ItemTypeInterface $itemType
     * @return object
     */
    public function itemTypeUpdateQuality(ItemTypeInterface $itemType): object{
        return $itemType->updateItemQuality();
    }

    /**
     * Iterates through each item and updates their properties differently depending on type
     */
    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {

                case $this->checkItemType($item->name, 'Aged Brie'):
                    $itemType = new AgedBrie($item);
                    $this->itemTypeUpdateQuality($itemType);
                    break;

                case ($this->checkItemType($item->name, 'Backstage passes') && $item->quality < 50):
                    $itemType = new BackstageTicket($item);
                    $this->itemTypeUpdateQuality($itemType);
                    break;

                case ($this->checkItemType($item->name, 'Sulfuras')):
                    $itemType = new Sulfuras($item);
                    $this->itemTypeUpdateQuality($itemType);
                    break;

                case ($this->checkItemType($item->name, 'Conjured')):
                    $itemType = new Conjured($item);
                    $this->itemTypeUpdateQuality($itemType);
                    break;

                default:
                    $itemType = new Common($item);
                    $this->itemTypeUpdateQuality($itemType);
            }
        }
    }
}
