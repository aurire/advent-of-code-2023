<?php

declare(strict_types=1);

namespace Days;

use AOC\Days\Day01;
use PHPUnit\Framework\TestCase;

class Day01Test extends TestCase
{
    public function testDay1(): void
    {
        $day1 = new Day01();
        $result = $day1->part1('test.txt');
        $this->assertEquals(142, $result);

        $result = $day1->part1('real.txt');
        $this->assertEquals(55029, $result);
    }

    public function testDay1Part2(): void
    {
        $day1 = new Day01();
        $result = $day1->part2('test2.txt');
        $this->assertEquals(281, $result);

        $result = $day1->part2('real.txt');
        $this->assertEquals(55686, $result);
    }
}