<?php

declare(strict_types=1);

namespace AOC\Days;

use AOC\DayBase;

class Day01 extends DayBase
{
    public function part1(string $testCase): int
    {
        $lines   = $this->getLines($testCase);
        $sum = 0;

        foreach ($lines as $line) {
            $number = '';
            foreach (str_split($line) as $item) {
                if (ctype_digit($item)) {
                    $number .= $item;
                    break;
                }
            }
            foreach (array_reverse(str_split($line)) as $item) {
                if (ctype_digit($item)) {
                    $number .= $item;
                    break;
                }
            }
            $sum += (int) $number;
        }

        return $sum;
    }

    public function part2(string $testCase): int
    {
        $lines   = $this->getLines($testCase);
        $sum = 0;

        $search = ['three', 'seven', 'eight', 'four', 'five', 'nine', 'one', 'two', 'six'];
        $replace = ['3', '7', '8', '4', '5', '9', '1', '2', '6'];

        foreach ($lines as $line) {
            $number = '';
            while (true) {
                $lowest = 999;
                $lowestWhich = false;
                foreach ($search as $s) {
                    $pos = strpos($line, $s);
                    if ($pos !== false && $pos < $lowest) {
                        $lowest = $pos;
                        $lowestWhich = $s;
                    }
                }
                if ($lowestWhich === false) {
                    break;
                }
                $posInRep = array_search($lowestWhich, $search, true);
                $repl = $replace[$posInRep];
                $replSubject = $lowestWhich[0] . $repl . substr($lowestWhich, 1);
                $line = str_replace($lowestWhich, $replSubject, $line);
            }

            foreach (str_split($line) as $item) {
                if (ctype_digit($item)) {
                    $number .= $item;
                    break;
                }
            }

            foreach (array_reverse(str_split($line)) as $item) {
                if (ctype_digit($item)) {
                    $number .= $item;
                    break;
                }
            }
            $sum += (int) $number;
        }

        return $sum;
    }

    public function getLines(string $fileName): array
    {
        return $this->getDayLines(__FILE__, $fileName);
    }
}
