<?php

declare(strict_types=1);

namespace GildedRose;

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

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {

                case (str_contains(ucfirst($item->name), 'Aged Brie')):
                    if ($item->quality < 50) $item->quality += 1;
                        $item->sell_in -= 1;
                    break;

                case (str_contains(ucfirst($item->name), 'Backstage passes') && $item->quality < 50): {
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

                case (str_contains(ucfirst($item->name), 'Sulfuras')):
                    $item->quality = 80;
                    break;

                case (str_contains(ucfirst($item->name), 'Conjured')):
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
