<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testNewItemAndUpdateQuality(): void
    {
        $items = [new Item('Apple', 2, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Apple', $items[0]->name);
        $this->assertSame(1, $items[0]->sell_in);
        $this->assertSame(1, $items[0]->quality);
    }

    public function testSulfurasAndQualityOverTime(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(80, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(80, $items[0]->quality);
    }

    public function testAgedBrieAndQualityOverTime(): void
    {
        $items = [new Item('Aged Brie', 5, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Aged Brie', $items[0]->name);
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(3, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(3, $items[0]->sell_in);
        $this->assertSame(4, $items[0]->quality);
    }

    public function testIfAgedBrieMaxQualityIs50(): void
    {
        $items = [new Item('Aged Brie', 5, 49)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Aged Brie', $items[0]->name);
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(3, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testIfQualityDegradesTwiceAsFastAfterSellIn(): void
    {
        $items = [new Item('Shield', 1, 35)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Shield', $items[0]->name);
        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(34, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(32, $items[0]->quality);
    }

    public function testIfQualityDegradesTwiceAsFastAfterSellInForConjuredItems(): void
    {
        $items = [new Item('Conjured Shield', 1, 35)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Conjured Shield', $items[0]->name);
        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(33, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(29, $items[0]->quality);
    }

    public function testIfQualityOfAConjuredItemIsNeverNegative(): void
    {
        $items = [new Item('Conjured Shield', 0, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(1, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(-2, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testIfQualityOfAnItemIsNeverNegative(): void
    {
        $items = [new Item('Shield', 0, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(-2, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testBackstagePassesQualityWhenMoreThan10DaysLeft(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->sell_in);
        $this->assertSame(6, $items[0]->quality);
    }

    public function testBackstagePassesQualityWhen10OrLessDaysLeft(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(7, $items[0]->quality);
    }

    public function testBackstagePassesQualityWhen5OrLessDaysLeft(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(8, $items[0]->quality);
    }

    public function testIfBackstagePassMaxQualityIs50(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 48)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePassesQualityAfterSellIn(): void
    {
        $items = [new Item('Backstage passes to a Metallica concert', 0, 8)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testOneDayMultipleItemsUpdateQuality(): void
    {
        $items = [
            new Item('+5 Zweihander', 10, 20),
            new Item('Aged Brie Dziugas', 7, 0),
            new Item('Shield of Sulfuras', 0, 80),
            new Item('Backstage passes to a Folktale concert', 10, 20),
            new Item('Conjured Sausage', 3, 6),
        ];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertCount(5, $gildedRose->getItems());
        $this->assertSame('+5 Zweihander', $items[0]->name);
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(19, $items[0]->quality);

        $this->assertSame('Aged Brie Dziugas', $items[1]->name);
        $this->assertSame(6, $items[1]->sell_in);
        $this->assertSame(1, $items[1]->quality);

        $this->assertSame('Shield of Sulfuras', $items[2]->name);
        $this->assertSame(0, $items[2]->sell_in);
        $this->assertSame(80, $items[2]->quality);

        $this->assertSame('Backstage passes to a Folktale concert', $items[3]->name);
        $this->assertSame(9, $items[3]->sell_in);
        $this->assertSame(22, $items[3]->quality);

        $this->assertSame('Conjured Sausage', $items[4]->name);
        $this->assertSame(2, $items[4]->sell_in);
        $this->assertSame(4, $items[4]->quality);
    }
}
