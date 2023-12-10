<?php

declare(strict_types=1);

namespace AOC\Days;

use AOC\DayBase;

class Day05 extends DayBase
{
    public function part1(string $testCase): int
    {
        $seedsAndMaps = $this->parse($testCase);
        $seeds = $seedsAndMaps['seeds'];
        $maps = $seedsAndMaps['maps'];


        return 1;
    }

    public function part2(string $testCase): int
    {
        $games = $this->getLines($testCase);

        return array_sum($games);
    }

    public function parse(string $testCase): array
    {
        $lines = $this->getLines($testCase);

        $seeds = array_shift($lines);
        array_shift($lines);

        $maps = [];
        $currentMap = false;
        $nextIsMapName = true;
        foreach ($lines as $line) {
            if ($nextIsMapName) {
                $currentMap = str_replace(' map:', '', $line);
                $nextIsMapName = false;
            } elseif (empty($line)) {
                $nextIsMapName = true;
                $currentMap = false;
            } elseif ($currentMap !== false) {
                $maps[$currentMap][] = array_map('intval', explode(' ', $line));
            }
        }

        return [
            'seeds' => array_map('intval', explode(' ', str_replace('seeds: ', '', $seeds))),
            'maps' => $maps,
        ];
    }

    private function getLines(string $fileName): array
    {
        return $this->getDayLines(__FILE__, $fileName, false);
    }
}
