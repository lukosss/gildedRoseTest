<?php


namespace GildedRose\ItemTypes;

use GildedRose\ItemTypeInterface;

class AgedBrie implements ItemTypeInterface
{

    public function updateItemQuality(int $quality): int
    {
        if ($quality < 50) $quality += 1;
        return $quality;
    }
}