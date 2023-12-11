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

    public function testGetDestinationRangesBySourceRange(): void
    {
        $rangeMap = new RangeMap();
        $rangeMap->addRange(102, 2, 4);
        $rangeMap->addRange(109, 9, 6);
        $rangeMap->addRange(118, 18, 4);

        $result = $rangeMap->getDestinationRangesBySourceRange(3, 12);

        $this->assertEquals(103, $result[0][0]);
        $this->assertEquals(105, $result[0][1]);
        $this->assertEquals(6, $result[1][0]);
        $this->assertEquals(8, $result[1][1]);
        $this->assertEquals(109, $result[2][0]);
        $this->assertEquals(112, $result[2][1]);

        $result = $rangeMap->getDestinationRangesBySourceRange(1, 100);

        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(1, $result[0][1]);
        $this->assertEquals(102, $result[1][0]);
        $this->assertEquals(105, $result[1][1]);
        $this->assertEquals(6, $result[2][0]);
        $this->assertEquals(8, $result[2][1]);
        $this->assertEquals(109, $result[3][0]);
        $this->assertEquals(114, $result[3][1]);
        $this->assertEquals(15, $result[4][0]);
        $this->assertEquals(17, $result[4][1]);
        $this->assertEquals(118, $result[5][0]);
        $this->assertEquals(121, $result[5][1]);
        $this->assertEquals(22, $result[6][0]);
        $this->assertEquals(100, $result[6][1]);

        $result = $rangeMap->getDestinationRangesBySourceRange(0, 3);

        $this->assertEquals(0, $result[0][0]);
        $this->assertEquals(1, $result[0][1]);
        $this->assertEquals(102, $result[1][0]);
        $this->assertEquals(103, $result[1][1]);
    }

    public function testGetDestinationRangesBySourceRanges(): void
    {
        $rangeMap = new RangeMap();
        $rangeMap->addRange(102, 2, 4);
        $rangeMap->addRange(109, 9, 6);
        $rangeMap->addRange(118, 18, 4);

        $result = $rangeMap->getDestinationRangesBySourceRanges([[3, 7], [20, 23]]);

        $this->assertEquals(103, $result[0][0]);
        $this->assertEquals(105, $result[0][1]);
        $this->assertEquals(6, $result[1][0]);
        $this->assertEquals(7, $result[1][1]);
        $this->assertEquals(120, $result[2][0]);
        $this->assertEquals(121, $result[2][1]);
        $this->assertEquals(22, $result[3][0]);
        $this->assertEquals(23, $result[3][1]);
    }
}
