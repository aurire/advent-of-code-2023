<?php

declare(strict_types=1);

namespace AOC\Days;

use AOC\DayBase;

class Day04 extends DayBase
{
    public function part1(string $testCase): int
    {
        $games = $this->parse($testCase);
        $sum = 0;
        foreach ($games as $game) {
            $intered = array_intersect($game[0], $game[1]);
            $sum += count($intered) > 0 ? (2 ** (count($intered) - 1)) : 0;
        }

        return $sum;
    }

    public function part2(string $testCase): int
    {
        $games = $this->parse($testCase);
        $winTable = [];
        foreach ($games as $gameNr => $game) {
            $intered = array_intersect($game[0], $game[1]);
            $winTable[$gameNr] = count($intered);
        }

        $sum = 0;
        foreach ($winTable as $gameNr => $won) {
            ++$sum;
            $sum += $this->calcWins($winTable, $gameNr, $won);
        }

        return $sum;
    }

    private function calcWins(array $winTable, int $gameNr, int $won): int
    {
        if ($won === 0) {
            return 0;
        }

        $sum = 0;
        $i = $gameNr + 1;
        while ($won > 0) {
            $sum += 1;
            if (!isset($winTable[$i])) {
                break;
            }
            $won2 = $winTable[$i];
            $sum += $this->calcWins($winTable, $i, $won2);
            $won--;
            $i++;
        }

        return $sum;
    }

    public function parse(string $file): array
    {
        $parsed = [];
        foreach ($this->getLines($file) as $line) {
            $parts = explode(': ', str_replace('Card ', '', $line));
            $cardNr = (int) $parts[0];
            $stacks = explode(' | ', $parts[1]);
            $lucky = array_map('intval', array_filter(explode(' ', str_replace('  ', ' ', $stacks[0]))));
            $cardNumbers = array_map('intval', array_filter(explode(' ', str_replace('  ', ' ', $stacks[1]))));
            $parsed[$cardNr] = [$lucky, $cardNumbers];
        }

        return $parsed;
    }

    private function getLines(string $fileName): array
    {
        return $this->getDayLines(__FILE__, $fileName);
    }
}
