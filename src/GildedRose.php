<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ItemTypes\AgedBrie;

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
     * @param ItemTypeInterface $itemType
     * @param int $quality
     * @return int
     */
    public function itemTypeUpdateQuality(ItemTypeInterface $itemType, int $quality): int{
        return $itemType->updateItemQuality($quality);
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {

                case $this->checkItemType($item->name, 'Aged Brie'):
                    $itemType = new AgedBrie();
                    $item->quality = $this->itemTypeUpdateQuality($itemType, $item->quality);
                    $item->sell_in -= 1;
                    break;

                case ($this->checkItemType($item->name, 'Backstage passes') && $item->quality < 50): {
                    switch ($item->sell_in){
                        case ($item->sell_in < 0):
                            $item->quality = 0;
                            $item->sell_in -= 1;
                            break;

                        case ($item->sell_in < 6):
                            $item->quality += 3;
                            $item->sell_in -= 1;
                            break;

                        case ($item->sell_in < 11):
                            $item->quality += 2;
                            $item->sell_in -= 1;
                            break;

                        case ($item->sell_in >= 11):
                            $item->quality += 1;
                            $item->sell_in -= 1;
                            break;
                    }
                }
                    break;

                case ($this->checkItemType($item->name, 'Sulfuras')):
                    $item->quality = 80;
                    break;

                case ($this->checkItemType($item->name, 'Conjured')):
                    if ($item->quality > 1 && $item->sell_in > 0) {
                        $item->quality -= 2;
                    } elseif ($item->quality > 3 && $item->sell_in <= 0) {
                        $item->quality -= 4;
                    } elseif ($item->quality <= 3 && $item->sell_in <= 0) {
                        $item->quality = 0;
                    }
                    $item->sell_in -= 1;
                    break;

                default:
                    if ($item->quality > 0 && $item->sell_in > 0) {
                        $item->quality -= 1;
                    } elseif ($item->quality > 1 && $item->sell_in <= 0) {
                        $item->quality -= 2;
                    } elseif ($item->quality == 1 && $item->sell_in <= 0) {
                        $item->quality -= 1;
                    }
                    $item->sell_in -= 1;
            }
        }
    }
}
