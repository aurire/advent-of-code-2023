<?php

declare(strict_types=1);

namespace AOC\DataStruct\Range;

class RangeNode
{
    private ?RangeNode $next;

    private int $sourceTo;

    public function __construct(
        protected int $destinationFrom,
        protected int $sourceFrom,
        protected int $length
    ) {
        $this->sourceTo = $sourceFrom + $length - 1;
        $this->next = null;
    }

    public function setNext(?RangeNode $node)
    {
        $this->next = $node;
    }

    /**
     * @return RangeNode|null
     */
    public function getNext(): ?RangeNode
    {
        return $this->next;
    }

    /**
     * @return int
     */
    public function getDestinationFrom(): int
    {
        return $this->destinationFrom;
    }

    /**
     * @return int
     */
    public function getSourceFrom(): int
    {
        return $this->sourceFrom;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getSourceTo(): int
    {
        return $this->sourceTo;
    }


}
