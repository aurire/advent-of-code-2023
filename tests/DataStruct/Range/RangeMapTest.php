<?php

declare(strict_types=1);

namespace DataStruct\Range;

use AOC\DataStruct\Range\RangeMap;
use PHPUnit\Framework\TestCase;

class RangeMapTest extends TestCase
{
    public function testGetDestinationBySource(): void
    {
        $rangeMap = new RangeMap();
        $rangeMap->addRange(1000, 100, 20);
        $rangeMap->addRange(900, 10, 50);
        $rangeMap->addRange(1100, 200, 60);

        $this->assertEquals(5, $rangeMap->getDestinationBySource(5));
        $this->assertEquals(902, $rangeMap->getDestinationBySource(12));
        $this->assertEquals(919, $rangeMap->getDestinationBySource(29));
        $this->assertEquals(920, $rangeMap->getDestinationBySource(30));
        $this->assertEquals(950, $rangeMap->getDestinationBySource(60));
        $this->assertEquals(61, $rangeMap->getDestinationBySource(61));
        $this->assertEquals(1000, $rangeMap->getDestinationBySource(100));
        $this->assertEquals(1010, $rangeMap->getDestinationBySource(110));
        $this->assertEquals(1020, $rangeMap->getDestinationBySource(120));
        $this->assertEquals(121, $rangeMap->getDestinationBySource(121));
        $this->assertEquals(1100, $rangeMap->getDestinationBySource(200));
        $this->assertEquals(1160, $rangeMap->getDestinationBySource(260));
        $this->assertEquals(261, $rangeMap->getDestinationBySource(261));
    }
}
