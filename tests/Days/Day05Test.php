<?php

declare(strict_types=1);

namespace Days;

use AOC\Days\Day05;
use PHPUnit\Framework\TestCase;

class Day05Test extends TestCase
{
    public function testPart1(): void
    {
        $day = new Day05();

        $this->assertEquals(35, $day->part1('test.txt'));
        $this->assertEquals(51752125, $day->part1('real.txt'));
    }

    public function testPart2(): void
    {
        $day = new Day05();

        $this->assertEquals(46, $day->part2('test.txt'));
        $this->assertEquals(12634632, $day->part2('real.txt'));
    }
}
