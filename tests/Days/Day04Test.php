<?php

declare(strict_types=1);

namespace Days;

use AOC\Days\Day04;
use PHPUnit\Framework\TestCase;

class Day04Test extends TestCase
{
    public function testPart1(): void
    {
        $day = new Day04();

        $this->assertEquals(13, $day->part1('test.txt'));
        $this->assertEquals(21158, $day->part1('real.txt'));
    }

    public function testPart2(): void
    {
        $day = new Day04();

        $this->assertEquals(30, $day->part2('test.txt'));
        $this->assertEquals(6050769, $day->part2('real.txt'));
    }
}
