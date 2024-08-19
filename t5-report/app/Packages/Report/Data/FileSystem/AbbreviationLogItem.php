<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem;

/**
 * Just a class that is used instead of associative array.
 */
class AbbreviationLogItem
{
    public string $abbreviation;
    public string $fullName;
    public string $car;

    public function __construct(string $abbreviation, string $fullName, string $car)
    {
        $this->abbreviation = $abbreviation;
        $this->fullName     = $fullName;
        $this->car          = $car;
    }
}
