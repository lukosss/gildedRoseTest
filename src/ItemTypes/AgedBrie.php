<?php


namespace GildedRose\ItemTypes;

use GildedRose\ItemTypeInterface;

class AgedBrie implements ItemTypeInterface
{
    /**
     * @var object
     */
    private $item;

    public function __construct(object $item)
    {
        $this->item = $item;
    }

    public function updateItemQuality(): object
    {
        if ($this->item->quality < 50) $this->item->quality += 1;

        $this->item->sell_in -= 1;
        return $this->item;
    }
}