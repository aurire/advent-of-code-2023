<?php

declare(strict_types=1);

namespace AOC\Days;

use AOC\DataStruct\Entities\SeedInfo;
use AOC\DataStruct\Range\RangeMap;
use AOC\DayBase;

class Day05 extends DayBase
{
    public function part1(string $testCase): int
    {
        $seedsAndMaps = $this->parse($testCase);
        $seeds = $seedsAndMaps['seeds'];
        $ranges = $this->getRanges($seedsAndMaps['maps']);

        $seedInfos = [];
        foreach ($seeds as $seed) {
            $seedInfo = $this->getSeedInfo($seed, $ranges);
            $seedInfos[] = $seedInfo;
        }

        $lowestLocation = PHP_INT_MAX;

        foreach ($seedInfos as $seedInfo) {
            if ($seedInfo->getLocation() < $lowestLocation) {
                $lowestLocation = $seedInfo->getLocation();
            }
        }

        return $lowestLocation;
    }

    public function part2(string $testCase): int
    {
        $seedsAndMaps = $this->parse($testCase);
        $seeds = $seedsAndMaps['seeds'];
        $ranges = $this->getRanges($seedsAndMaps['maps']);

        $first = true;
        $from = 0;
        $lowestLocation = PHP_INT_MAX;
        foreach ($seeds as $seed) {
            if ($first) {
                $from = $seed;
                $first = false;
            } else {
                $upTo = $from + $seed - 1;

                $soilRanges = $ranges['seed-to-soil']->getDestinationRangesBySourceRange($from, $upTo);
                $fertilizerRanges = $ranges['soil-to-fertilizer']->getDestinationRangesBySourceRanges($soilRanges);
                $waterRanges = $ranges['fertilizer-to-water']->getDestinationRangesBySourceRanges($fertilizerRanges);
                $lightRanges = $ranges['water-to-light']->getDestinationRangesBySourceRanges($waterRanges);
                $temperatureRanges = $ranges['light-to-temperature']->getDestinationRangesBySourceRanges($lightRanges);
                $humidityRanges = $ranges['temperature-to-humidity']->getDestinationRangesBySourceRanges(
                    $temperatureRanges
                );
                $locationRanges = $ranges['humidity-to-location']->getDestinationRangesBySourceRanges($humidityRanges);

                $lowestInRanges = $this->getLowestInRanges($locationRanges);

                if ($lowestInRanges < $lowestLocation) {
                    $lowestLocation = $lowestInRanges;
                }

                $first = true;
            }
        }

        return $lowestLocation;
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

    private function getRanges(array $maps): array
    {
        $ranges = [];
        foreach ($maps as $mapName => $map) {
            $mapRange = new RangeMap();
            $ranges[$mapName] = $mapRange;
            foreach ($map as $item) {
                $ranges[$mapName]->addRange($item[0], $item[1], $item[2]);
            }
        }

        return $ranges;
    }

    private function getSeedInfo(int $seed, array $ranges): SeedInfo
    {
        $seedInfo = new SeedInfo($seed);
        $seedInfo->setSoil($ranges['seed-to-soil']->getDestinationBySource($seed));
        $seedInfo->setFertilizer($ranges['soil-to-fertilizer']->getDestinationBySource($seedInfo->getSoil()));
        $seedInfo->setWater($ranges['fertilizer-to-water']->getDestinationBySource($seedInfo->getFertilizer()));
        $seedInfo->setLight($ranges['water-to-light']->getDestinationBySource($seedInfo->getWater()));
        $seedInfo->setTemperature($ranges['light-to-temperature']->getDestinationBySource($seedInfo->getLight()));
        $seedInfo->setHumidity($ranges['temperature-to-humidity']
            ->getDestinationBySource($seedInfo->getTemperature()));
        $seedInfo->setLocation($ranges['humidity-to-location']->getDestinationBySource($seedInfo->getHumidity()));

        return $seedInfo;
    }

    private function getLowestInRanges(array $locationRanges): int
    {
        $lowest = PHP_INT_MAX;
        foreach ($locationRanges as $locationRange) {
            if ($locationRange[0] < $lowest) {
                $lowest = $locationRange[0];
            }
        }

        return $lowest;
    }
}
