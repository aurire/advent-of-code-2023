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
}