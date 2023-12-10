<?php

declare(strict_types=1);

namespace Days;

use AOC\Days\Day01;
use AOC\Days\Day07;
use PHPUnit\Framework\TestCase;

class Day999Test extends TestCase
{
    public function testPart1(): void
    {
        $day = new Day01();

        $this->assertEquals(111, $day->part1('test.txt'));
        $this->assertEquals(222, $day->part1('real.txt'));
    }

    public function testPart2(): void
    {
        $day = new Day07();

        $this->assertEquals(1000, $day->part2('test.txt'));
        $this->assertEquals(10000, $day->part2('real.txt'));
    }
}
