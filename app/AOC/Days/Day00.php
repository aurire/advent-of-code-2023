<?php

declare(strict_types=1);

namespace AOC\Days;

use AOC\DayBase;

class Day00 extends DayBase
{
    public function part1(string $testCase): int
    {
        $games = $this->getLines($testCase);

        return array_sum($games);
    }

    public function part2(string $testCase): int
    {
        $games = $this->getLines($testCase);

        return array_sum($games);
    }

    public function getLines(string $fileName): array
    {
        return $this->getDayLines(__FILE__, $fileName);
    }
}
