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
            if (!str_contains(ucfirst($item->name), 'Aged Brie') && !str_contains(ucfirst($item->name), 'Backstage passes')) {
                if ($item->quality > 0) {
                    if (!str_contains(ucfirst($item->name), 'Sulfuras')) {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if (str_contains(ucfirst($item->name), 'Backstage passes')) {
                        if ($item->sell_in < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if (!str_contains(ucfirst($item->name), 'Sulfuras')) {
                $item->sell_in = $item->sell_in - 1;
            }

            if ($item->sell_in < 0) {
                if (!str_contains(ucfirst($item->name), 'Aged Brie')) {
                    if (!str_contains(ucfirst($item->name), 'Backstage passes')) {
                        if ($item->quality > 0) {
                            if (!str_contains(ucfirst($item->name), 'Sulfuras')) {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
