<?php

declare(strict_types=1);

namespace Days;

use AOC\Days\Day06;
use PHPUnit\Framework\TestCase;

class Day06Test extends TestCase
{
    public function testPart1(): void
    {
        $day = new Day06();

        $this->assertEquals(288, $day->part1('test.txt'));
        $this->assertEquals(222, $day->part1('real.txt'));
    }

    public function testPart2(): void
    {
        $day = new Day06();

        $this->assertEquals(71503, $day->part2('test.txt'));
        $this->assertEquals(45647654, $day->part2('real.txt'));
    }
}
