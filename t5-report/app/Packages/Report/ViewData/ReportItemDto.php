<?php

declare(strict_types=1);

namespace App\Packages\Report\ViewData;

/**
 * One item in ReportToDtosConverter::convert() result array
 */
class ReportItemDto
{
    public function __construct(
        public int $position,
        public string $abbreviation,
        public string $fullName,
        public string $car,
        public string $bestTime
    ) {
    }
}
