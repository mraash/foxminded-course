<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem;

use DateTimeImmutable;

/**
 * Just a class that is used instead of associative array.
 */
class TimeLogItem
{
    public string $abbreviation;
    public DateTimeImmutable $dateTime;

    public function __construct(string $abbreviation, string $date, string $time)
    {
        $this->abbreviation = $abbreviation;
        $this->dateTime     = new DateTimeImmutable("{$date} {$time}");
    }
}
