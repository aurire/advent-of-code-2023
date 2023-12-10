<?php

declare(strict_types=1);

namespace AOC;

class DayBase
{
    public function getDayLines(string $currentClass, string $fileName, bool $filter = true): array
    {
        $parts = explode('AOC', $currentClass);
        $dataDir = dirname($parts[0]) . DIRECTORY_SEPARATOR . 'data' . str_replace('.php', '', $parts[1]);
        $filePlace = $dataDir . DIRECTORY_SEPARATOR . $fileName;
        $lines = explode("\n", file_get_contents($filePlace));

        return $filter ? array_filter($lines) : $lines;
    }
}
