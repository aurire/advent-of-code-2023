<?php

declare(strict_types=1);

namespace AOC\Days;

use AOC\DayBase;

class Day06 extends DayBase
{
    public function part1(string $testCase): int
    {
        [$times, $distances] = $this->parse($testCase);

        $i = 0;
        $mult = 1;
        foreach ($times as $time) {
            $distance = $distances[$i];

            // distance = buttonTime * (totalTime - buttonTime)
            $cnt = 0;
            for ($buttonTime = 0; $buttonTime <= $time; $buttonTime++) {
                $dist = $buttonTime * ($time - $buttonTime);
                if ($dist > $distance) {
                    $cnt++;
                }
            }
            $mult *= $cnt;

            $i++;
        }

        return $mult;
    }

    public function part2(string $testCase): int
    {
        [$time, $distance] = $this->parse2($testCase);

        $cnt = 0;
        for ($buttonTime = 0; $buttonTime <= $time; $buttonTime++) {
            $dist = $buttonTime * ($time - $buttonTime);
            if ($dist > $distance) {
                $cnt++;
            }
        }

        return $cnt;
    }

    public function parse(string $fileName): array
    {
        $lines = $this->getLines($fileName);
        $times = array_filter(explode(' ', $lines[0]));
        $distances = array_filter(explode(' ', $lines[1]));
        array_shift($times);
        array_shift($distances);

        return [
            array_map('intval', $times),
            array_map('intval', $distances),
        ];
    }

    private function parse2(string $testCase): array
    {
        $lines = $this->getLines($testCase);
        $times = array_filter(explode(' ', $lines[0]));
        $distances = array_filter(explode(' ', $lines[1]));
        array_shift($times);
        array_shift($distances);

        return [
            (int) implode($times),
            (int) implode($distances),
        ];
    }

    private function getLines(string $fileName): array
    {
        return $this->getDayLines(__FILE__, $fileName);
    }
}
