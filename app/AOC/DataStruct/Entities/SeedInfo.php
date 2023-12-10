<?php

declare(strict_types=1);

namespace AOC\DataStruct\Entities;

class SeedInfo
{
    public function __construct(
        protected int  $seed,
        protected ?int $soil = null,
        protected ?int $fertilizer = null,
        protected ?int $water = null,
        protected ?int $light = null,
        protected ?int $temperature = null,
        protected ?int $humidity = null,
        protected ?int $location = null,
    )
    {
    }

    /**
     * @return int
     */
    public function getSeed(): int
    {
        return $this->seed;
    }

    /**
     * @param int $seed
     */
    public function setSeed(int $seed): void
    {
        $this->seed = $seed;
    }

    /**
     * @return int|null
     */
    public function getSoil(): ?int
    {
        return $this->soil;
    }

    /**
     * @param int|null $soil
     */
    public function setSoil(?int $soil): void
    {
        $this->soil = $soil;
    }

    /**
     * @return int|null
     */
    public function getFertilizer(): ?int
    {
        return $this->fertilizer;
    }

    /**
     * @param int|null $fertilizer
     */
    public function setFertilizer(?int $fertilizer): void
    {
        $this->fertilizer = $fertilizer;
    }

    /**
     * @return int|null
     */
    public function getWater(): ?int
    {
        return $this->water;
    }

    /**
     * @param int|null $water
     */
    public function setWater(?int $water): void
    {
        $this->water = $water;
    }

    /**
     * @return int|null
     */
    public function getLight(): ?int
    {
        return $this->light;
    }

    /**
     * @param int|null $light
     */
    public function setLight(?int $light): void
    {
        $this->light = $light;
    }

    /**
     * @return int|null
     */
    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    /**
     * @param int|null $temperature
     */
    public function setTemperature(?int $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return int|null
     */
    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    /**
     * @param int|null $humidity
     */
    public function setHumidity(?int $humidity): void
    {
        $this->humidity = $humidity;
    }

    /**
     * @return int|null
     */
    public function getLocation(): ?int
    {
        return $this->location;
    }

    /**
     * @param int|null $location
     */
    public function setLocation(?int $location): void
    {
        $this->location = $location;
    }
}
