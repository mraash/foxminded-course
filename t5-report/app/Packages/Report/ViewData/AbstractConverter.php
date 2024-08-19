<?php

declare(strict_types=1);

namespace App\Packages\Report\ViewData;

use App\Exceptions\InvalidReturnException;
use App\Packages\Report\Racers\Racer;
use App\Packages\Report\Report;

abstract class AbstractConverter
{
    /**
     * @return mixed[]
     */
    abstract public function convert(Report $report): array;

    /**
     * Get formatted best time of $racer.
     */
    protected static function getRacerBestTime(Racer $racer): string
    {
        $bestTime = $racer->getBestTime()->format('%H:%I:%S.%F');

        // $bestTime contain 6 digits after dot. This code will cut last 3.
        $result = preg_replace('/...$/', '', $bestTime);

        if ($result === null) {
            throw new InvalidReturnException();
        }

        return $result;
    }
}
