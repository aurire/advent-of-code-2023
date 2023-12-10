<?php

declare(strict_types=1);

namespace Days;

use AOC\DataStruct\Geometry\DirectionEnum;
use AOC\DataStruct\Geometry\Pnt;
use AOC\Days\Day03;
use PHPUnit\Framework\TestCase;

class Day03Test extends TestCase
{
    public function testPart1(): void
    {
        $day = new Day03();

        $this->assertEquals(4361, $day->part1('test.txt'));
        $this->assertEquals(540131, $day->part1('real.txt'));
    }

    public function testPart2(): void
    {
        $day = new Day03();

        $this->assertEquals(467835, $day->part2('test.txt'));
        $this->assertEquals(86879020, $day->part2('real.txt'));
    }

    public function testGetByPointAndDirection(): void
    {
        $day = new Day03();

        $line1 = ['1', 'A', '/'];
        $line2 = ['B', '*', '['];
        $line3 = ['X', '5', 'Z'];
        $lines = [$line1, $line2, $line3];

        $this->assertEquals('A', $day->getByPointAndDirection($lines, new Pnt(1, 1), DirectionEnum::Top));
        $this->assertEquals('1', $day->getByPointAndDirection($lines, new Pnt(1, 1), DirectionEnum::TopLeft));
        $this->assertEquals('B', $day->getByPointAndDirection($lines, new Pnt(1, 1), DirectionEnum::Left));
        $this->assertEquals('X', $day->getByPointAndDirection($lines, new Pnt(1, 1), DirectionEnum::DownLeft));
        $this->assertEquals('5', $day->getByPointAndDirection($lines, new Pnt(1, 1), DirectionEnum::Down));
        $this->assertEquals('Z', $day->getByPointAndDirection($lines, new Pnt(1, 1), DirectionEnum::DownRight));
        $this->assertEquals('[', $day->getByPointAndDirection($lines, new Pnt(1, 1), DirectionEnum::Right));
        $this->assertEquals('/', $day->getByPointAndDirection($lines, new Pnt(1, 1), DirectionEnum::TopRight));

        $this->assertNull($day->getByPointAndDirection($lines, new Pnt(0, 1), DirectionEnum::Top));
        $this->assertNull($day->getByPointAndDirection($lines, new Pnt(0, 1), DirectionEnum::TopLeft));
        $this->assertNull($day->getByPointAndDirection($lines, new Pnt(0, 1), DirectionEnum::TopRight));
        $this->assertEquals('1', $day->getByPointAndDirection($lines, new Pnt(0, 1), DirectionEnum::Left));

        $this->assertNull($day->getByPointAndDirection($lines, new Pnt(0, 2), DirectionEnum::Right));
        $this->assertNull($day->getByPointAndDirection($lines, new Pnt(2, 2), DirectionEnum::Right));
        $this->assertNull($day->getByPointAndDirection($lines, new Pnt(2, 2), DirectionEnum::DownRight));
        $this->assertNull($day->getByPointAndDirection($lines, new Pnt(2, 2), DirectionEnum::Down));
        $this->assertNull($day->getByPointAndDirection($lines, new Pnt(2, 2), DirectionEnum::DownLeft));
        $this->assertNull($day->getByPointAndDirection($lines, new Pnt(2, 0), DirectionEnum::Left));
    }

    public function testHasConnection(): void
    {
        $day = new Day03();

        $line1 = ['1', '2', '.'];
        $line2 = ['.', '.', '.'];
        $line3 = ['.', '.', '.'];
        $lines = [$line1, $line2, $line3];

        $this->assertFalse($day->hasConnection([new Pnt(0, 0), new Pnt(0, 1)], $lines));

        $lines[0][2] = '/';
        $this->assertTrue($day->hasConnection([new Pnt(0, 0), new Pnt(0, 1)], $lines));

        $lines[0][2] = '.';
        $this->assertFalse($day->hasConnection([new Pnt(0, 0), new Pnt(0, 1)], $lines));

        $lines[1][2] = '*';
        $this->assertTrue($day->hasConnection([new Pnt(0, 0), new Pnt(0, 1)], $lines));

        $lines[1][2] = '.';
        $this->assertFalse($day->hasConnection([new Pnt(0, 0), new Pnt(0, 1)], $lines));

        $lines[1][1] = '|';
        $this->assertTrue($day->hasConnection([new Pnt(0, 0), new Pnt(0, 1)], $lines));

        $lines[1][1] = '.';
        $this->assertFalse($day->hasConnection([new Pnt(0, 0), new Pnt(0, 1)], $lines));

        $lines[1][0] = 'v';
        $this->assertTrue($day->hasConnection([new Pnt(0, 0), new Pnt(0, 1)], $lines));
    }
}
