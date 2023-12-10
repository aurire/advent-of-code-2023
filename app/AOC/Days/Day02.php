<?php

declare(strict_types=1);

namespace AOC\Days;

use AOC\DayBase;

class Day02 extends DayBase
{
    public function part1(string $testCase): int
    {
        $games = $this->getGames($this->getLines($testCase));

        $fit = [];
        foreach ($games as $gameNr => $game) {
            if ($this->checkPossible($game, 12, 13, 14)) {
                $fit[] = $gameNr;
            }
        }

        return array_sum($fit);
    }

    public function part2(string $testCase): int
    {
        $games = $this->getGames($this->getLines($testCase));

        $sum = 0;
        foreach ($games as $game) {
            $maxes = $this->getMaxes($game);
            $sum += array_product($maxes);
        }

        return $sum;
    }

    public function getMaxes($game)
    {
        $redMax = 0;
        $greenMax = 0;
        $blueMax = 0;
        foreach ($game as $piles) {
            if (isset($piles['green']) && $piles['green'] > $greenMax) {
                $greenMax = $piles['green'];
            }
            if (isset($piles['blue']) && $piles['blue'] > $blueMax) {
                $blueMax = $piles['blue'];
            }
            if (isset($piles['red']) && $piles['red'] > $redMax) {
                $redMax = $piles['red'];
            }
        }

        return [
            'red' => $redMax,
            'green' => $greenMax,
            'blue' => $blueMax,
        ];
    }

    public function checkPossible($game, $red, $green, $blue): bool
    {
        $maxes = $this->getMaxes($game);

        return $maxes['red'] <= $red
            && $maxes['green'] <= $green
            && $maxes['blue'] <= $blue;
    }

    private function getGames(array $gameLines): array
    {
        $games = [];
        foreach ($gameLines as $gameLine) {
            $prts = explode(': ', str_replace('Game ', '', $gameLine));
            $gameNr = (int) $prts[0];
            $hands = explode('; ', $prts[1]);
            $parsedHand = [];
            foreach ($hands as $hand) {
                $parsedPiles = [];
                $piles = explode(', ', $hand);
                foreach ($piles as $pile) {
                    $handParts = explode(' ', $pile);
                    $parsedPiles[$handParts[1]] = (int) $handParts[0];
                }
                $parsedHand[] = $parsedPiles;
            }
            $games[$gameNr] = $parsedHand;
        }

        return $games;
    }

    private function getLines(string $fileName): array
    {
        return $this->getDayLines(__FILE__, $fileName);
    }
}
