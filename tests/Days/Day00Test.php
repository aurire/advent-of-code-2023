<?php

declare(strict_types=1);

namespace Days;

use AOC\Days\Day00;
use PHPUnit\Framework\TestCase;

class Day00Test extends TestCase
{
    public function testGetDayLines(): void
    {
        $day = new Day00();
        $lines = $day->getLines('test.txt');

        $this->assertIsArray($lines);
    }
}