<?php

declare(strict_types=1);

namespace App\Packages\Report\Racers;

use DateInterval;
use DateTimeImmutable;
use App\Packages\Report\Racers\Exceptions\TooLongBestTimeException;

class Racer
{
    private string $fullName;
    private string $abbreviation;
    private string $car;
    private DateInterval $bestTime;
    private DateTimeImmutable $bestTimeStart;
    private DateTimeImmutable $bestTimeEnd;

    public function __construct(
        string $abbreviation,
        string $fullName,
        string $car,
        DateTimeImmutable $start,
        DateTimeImmutable $end
    ) {
        $bestTime = $start->diff($end);

        /*
          In $bestTime->m can be 28, 29, 30 or 31 days, and this is a problem. But Racers probobly
          won't have so big best time, so we can throw an exception insted of fixing this problem.
        */
        if ($bestTime->m > 0 || $bestTime->y > 0) {
            throw new TooLongBestTimeException($fullName, $abbreviation);
        }

        $this->abbreviation  = $abbreviation;
        $this->fullName      = $fullName;
        $this->car           = $car;
        $this->bestTime      = $bestTime;
        $this->bestTimeStart = $start;
        $this->bestTimeEnd   = $end;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    public function getCar(): string
    {
        return $this->car;
    }

    public function getBestTimeStart(): DateTimeImmutable
    {
        return $this->bestTimeStart;
    }

    public function getBestTimeEnd(): DateTimeImmutable
    {
        return $this->bestTimeEnd;
    }

    public function getBestTime(): DateInterval
    {
        return $this->bestTime;
    }

    public function getBestTimeInMilliseconds(): int
    {
        $interval = $this->getBestTime();

        return (int)($interval->f * 1000)
            + $interval->s * 1000
            + $interval->i * 60 * 1000
            + $interval->h * 60 * 60 * 1000
            + $interval->d * 24 * 60 * 60 * 1000;
    }
}
