<?php


namespace GildedRose;


interface ItemTypeInterface
{
    public function updateItemQuality(int $quality): int;
}