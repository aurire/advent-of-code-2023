<?php

declare(strict_types=1);

namespace AOC\DataStruct\Geometry;

class Pnt
{
    public function __construct(protected int $y, protected int $x)
    {
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }
}