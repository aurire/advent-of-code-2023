<?php

declare(strict_types=1);

namespace AOC\Days;

use AOC\DataStruct\Geometry\DirectionEnum;
use AOC\DataStruct\Geometry\Pnt;
use AOC\DayBase;

class Day03 extends DayBase
{
    public function part1(string $testCase): int
    {
        $lines = $this->parse($testCase);
        $sum = 0;
        $y = 0;
        foreach ($lines as $line) {
            $nr = '';
            $digitRun = false;
            $digits = [];
            $x = 0;
            foreach ($line as $symb) {
                if (ctype_digit($symb)) {
                    $nr .= $symb;
                    $digitRun = true;
                    $digits[] = new Pnt($y, $x);
                } elseif ($digitRun) {
                    $digitRun = false;
                    if ($this->hasConnection($digits, $lines)) {
                        $sum += (int) $nr;
                    }
                    $nr = '';
                    $digits = [];
                }
                $x++;
            }

            if ($digitRun && $this->hasConnection($digits, $lines)) {
                $sum += (int) $nr;
            }

            $y++;
        }

        return $sum;
    }

    public function part2(string $testCase): int
    {
        $lines = $this->parse($testCase);

        $stars = [];

        $y = 0;
        foreach ($lines as $line) {
            $nr = '';
            $digitRun = false;
            $digits = [];
            $x = 0;
            foreach ($line as $symb) {
                if (ctype_digit($symb)) {
                    $nr .= $symb;
                    $digitRun = true;
                    $digits[] = new Pnt($y, $x);
                } elseif ($digitRun) {
                    $digitRun = false;
                    if (null !== ($starPoint = $this->hasStarSign($digits, $lines))) {
                        $stars[$starPoint][] = (int) $nr;
                    }
                    $nr = '';
                    $digits = [];
                }
                $x++;
            }

            if ($digitRun && null !== ($starPoint = $this->hasStarSign($digits, $lines))) {
                $stars[$starPoint][] = (int) $nr;
            }

            $y++;
        }

        return array_reduce($stars, fn($carry, $parts) => $carry + (count($parts) === 2 ? $parts[0] * $parts[1] : 0));
    }

    public function parse(string $testCase): array
    {
        $parsed = [];
        foreach ($this->getLines($testCase) as $line) {
            $parsed[] = str_split($line);
        }

        return $parsed;
    }

    public function getLines(string $fileName): array
    {
        return $this->getDayLines(__FILE__, $fileName);
    }

    public function getPtsToCheck(array $digits): array
    {
        $first = array_shift($digits);
        $toCheck = [
            [$first, DirectionEnum::Top],
            [$first, DirectionEnum::TopLeft],
            [$first, DirectionEnum::Left],
            [$first, DirectionEnum::DownLeft],
            [$first, DirectionEnum::Down],
        ];

        if (count($digits) > 0) {
            $last = array_pop($digits);

            foreach ($digits as $digit) {
                $toCheck[] = [$digit, DirectionEnum::Top];
                $toCheck[] = [$digit, DirectionEnum::Down];
            }
            $toCheck[] = [$last, DirectionEnum::Top];
            $toCheck[] = [$last, DirectionEnum::TopRight];
            $toCheck[] = [$last, DirectionEnum::Right];
            $toCheck[] = [$last, DirectionEnum::DownRight];
            $toCheck[] = [$last, DirectionEnum::Down];
        } else {
            $toCheck[] = [$first, DirectionEnum::TopRight];
            $toCheck[] = [$first, DirectionEnum::Right];
            $toCheck[] = [$first, DirectionEnum::DownRight];
        }

        return $toCheck;
    }

    public function hasStarSign(array $digits, array $lines): ?string
    {
        $toCheck = $this->getPtsToCheck($digits);

        foreach ($toCheck as $item) {
            $char = $this->getByPointAndDirection($lines, $item[0], $item[1]);
            if ($char === '*') {
                return $this->getByPointAndDirection($lines, $item[0], $item[1], true);
            }
        }

        return null;
    }

    public function hasConnection(array $digits, array $lines): bool
    {
        $toCheck = $this->getPtsToCheck($digits);

        foreach ($toCheck as $item) {
            $char = $this->getByPointAndDirection($lines, $item[0], $item[1]);
            if ($char === null || $char === '.') {
                continue;
            }
            return true;
        }

        return false;
    }

    public function getByPointAndDirection(
        array $lines,
        Pnt $pnt,
        DirectionEnum $direction,
        bool $returnCoords = false
    ): ?string {
        $bottom = count($lines) - 1;
        $right = count($lines[0]) - 1;

        if ($direction === DirectionEnum::Top) {
            if ($pnt->getY() === 0) {
                return null;
            }

            return $returnCoords
                ? ($pnt->getY() - 1) . '-' . $pnt->getX()
                : $lines[$pnt->getY() - 1][$pnt->getX()];
        } elseif ($direction === DirectionEnum::TopLeft) {
            if ($pnt->getY() === 0) {
                return null;
            }
            if ($pnt->getX() === 0) {
                return null;
            }

            return $returnCoords
                ? ($pnt->getY() - 1) . '-' . ($pnt->getX() - 1)
                : $lines[$pnt->getY() - 1][$pnt->getX() - 1];
        } elseif ($direction === DirectionEnum::Left) {
            if ($pnt->getX() === 0) {
                return null;
            }

            return $returnCoords
                ? $pnt->getY() . '-' . ($pnt->getX() - 1)
                : $lines[$pnt->getY()][$pnt->getX() - 1];
        } elseif ($direction === DirectionEnum::DownLeft) {
            if ($pnt->getX() === 0) {
                return null;
            }
            if ($pnt->getY() === $bottom) {
                return null;
            }

            return $returnCoords
                ? ($pnt->getY() + 1) . '-' . ($pnt->getX() - 1)
                : $lines[$pnt->getY() + 1][$pnt->getX() - 1];
        } elseif ($direction === DirectionEnum::Down) {
            if ($pnt->getY() === $bottom) {
                return null;
            }

            return $returnCoords
                ? ($pnt->getY() + 1) . '-' . $pnt->getX()
                : $lines[$pnt->getY() + 1][$pnt->getX()];
        } elseif ($direction === DirectionEnum::DownRight) {
            if ($pnt->getY() === $bottom) {
                return null;
            }
            if ($pnt->getX() === $right) {
                return null;
            }

            return $returnCoords
                ? ($pnt->getY() + 1) . '-' . ($pnt->getX() + 1)
                : $lines[$pnt->getY() + 1][$pnt->getX() + 1];
        } elseif ($direction === DirectionEnum::Right) {
            if ($pnt->getX() === $right) {
                return null;
            }

            return $returnCoords
                ? $pnt->getY() . '-' . ($pnt->getX() + 1)
                : $lines[$pnt->getY()][$pnt->getX() + 1];
        }

        //TopRight
        if ($pnt->getY() === 0) {
            return null;
        }
        if ($pnt->getX() === $right) {
            return null;
        }

        return $returnCoords
            ? ($pnt->getY() - 1) . '-' . ($pnt->getX() + 1)
            : $lines[$pnt->getY() - 1][$pnt->getX() + 1];
    }
}
