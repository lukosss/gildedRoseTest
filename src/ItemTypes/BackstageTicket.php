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
        switch ($this->item->sell_in){
            case ($this->item->sell_in < 0):
                $this->item->quality = 0;
                break;

            case ($this->item->sell_in < 6):
                $this->item->quality += 3;
                break;

            case ($this->item->sell_in < 11):
                $this->item->quality += 2;
                break;

            case ($this->item->sell_in >= 11):
                $this->item->quality += 1;
                break;
        }
        $this->item->sell_in -= 1;
        return $this->item;
    }
}