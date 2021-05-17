<?php


namespace GildedRose\ItemTypes;

use GildedRose\ItemTypeInterface;

class BackstageTicket implements ItemTypeInterface
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
        if($this->item->sell_in > 10) $this->item->quality += 1;
        if($this->item->sell_in <= 10 && $this->item->sell_in > 5) $this->item->quality += 2;
        if($this->item->sell_in <= 5 && $this->item->sell_in >= 0) $this->item->quality += 3;
        if($this->item->quality > 50) $this->item->quality = 50;
        if($this->item->sell_in <= 0) $this->item->quality = 0;
        $this->item->sell_in -= 1;
        return $this->item;
    }
}