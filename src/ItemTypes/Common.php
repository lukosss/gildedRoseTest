<?php

namespace GildedRose\ItemTypes;

use GildedRose\ItemTypeInterface;

class Common implements ItemTypeInterface
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
        ($this->item->sell_in > 0) ? --$this->item->quality : $this->item->quality -= 2;
        if($this->item->quality < 0) $this->item->quality = 0;
        --$this->item->sell_in;
        return $this->item;
    }
}
