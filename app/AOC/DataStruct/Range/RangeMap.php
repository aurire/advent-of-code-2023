<?php

declare(strict_types=1);

namespace AOC\DataStruct\Range;

class RangeMap
{
    private ?RangeNode $firstNode;

    public function __construct()
    {
        $this->firstNode = null;
    }

    public function addRange(int $destination, int $source, int $length)
    {
        $node = new RangeNode($destination, $source, $length);
        $smaller = $this->getInsertPlace($node->getSourceTo());
        if ($smaller === null) {
            $smallerNext = $this->firstNode;
            $this->firstNode = $node;
            $node->setNext($smallerNext);
        } else {
            $smallerNext = $smaller->getNext();
            $smaller->setNext($node);
            $node->setNext($smallerNext);
        }
    }

    public function getInsertPlace(int $value): ?RangeNode
    {
        $lastSmaller = null;
        $node = $this->firstNode;
        while ($node !== null) {
            if ($node->getSourceTo() > $value) {
                break;
            } else {
                $lastSmaller = $node;
            }
            $node = $node->getNext();
        }

        return $lastSmaller;
    }

    public function getDestinationBySource(int $source): int
    {
        $node = $this->firstNode;
        while ($node !== null) {
            if ($source < $node->getSourceFrom()) {
                return $source;
            } elseif ($source <= $node->getSourceTo()) {
                $diff = $source - $node->getSourceFrom();

                return $node->getDestinationFrom() + $diff;
            }
            $node = $node->getNext();
        }

        return $source;
    }

    public function getDestinationRangesBySourceRange(int $sourceFrom, int $sourceTo): array
    {
        $foundRanges = [];

        $node = $this->firstNode;
        if ($node->getSourceFrom() > 0) {
            $connectingNode = new RangeNode(
                0,
                0,
                $node->getSourceFrom()
            );
            $connectingNode->setNext($node);
            $node = $connectingNode;
        }
        while ($node !== null) {
            $distance = $node->getDestinationFrom() - $node->getSourceFrom();
            if ($sourceFrom <= $node->getSourceTo() && $sourceTo >= $node->getSourceFrom()) {
                $foundRanges[] = [
                    max($sourceFrom, $node->getSourceFrom()) + $distance,
                    min($sourceTo, $node->getSourceTo()) + $distance
                ];
            }
            $nextNode = $node->getNext();
            if (($node->getSourceTo() + 1) < ($nextNode?->getSourceFrom() ?? PHP_INT_MAX)) {
                $connectingNode = new RangeNode(
                    $node->getSourceTo() + 1,
                    $node->getSourceTo() + 1,
                    ($nextNode?->getSourceFrom() ?? PHP_INT_MAX) - $node->getSourceTo() - 1
                );
                $connectingNode->setNext($nextNode);
                $node = $connectingNode;
            } else {
                $node = $nextNode;
            }
        }

        return $foundRanges;
    }

    public function getDestinationRangesBySourceRanges(array $srcRanges): array
    {
        $result = [];
        foreach ($srcRanges as $srcRange) {
            $result[] = $this->getDestinationRangesBySourceRange($srcRange[0], $srcRange[1]);
        }

        return array_merge(...$result);
    }
}