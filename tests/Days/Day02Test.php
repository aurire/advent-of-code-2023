<?php

declare(strict_types=1);

namespace Days;

use AOC\Days\Day02;
use PHPUnit\Framework\TestCase;

class Day02Test extends TestCase
{
    public function testDay2Part1(): void
    {
        $day2 = new Day02();

        $this->assertEquals(8, $day2->part1('test.txt'));
        $this->assertEquals(2879, $day2->part1('real.txt'));
    }

    public function testDay2Part2(): void
    {
        $day2 = new Day02();

        $this->assertEquals(2286, $day2->part2('test.txt'));
        $this->assertEquals(65122, $day2->part2('real.txt'));
    }
}