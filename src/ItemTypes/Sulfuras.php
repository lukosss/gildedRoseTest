<?php


namespace GildedRose\ItemTypes;


use GildedRose\ItemTypeInterface;

class Sulfuras implements ItemTypeInterface
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
        $this->item->quality = 80;
        return $this->item;
    }
}