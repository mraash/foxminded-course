<?php

declare(strict_types=1);

namespace App\Packages\Report\ViewData;

use App\Packages\Report\Report;

class ReportToResourceConverter extends AbstractConverter
{
    /**
     * @return array<array<string,string|int>>
     */
    public function convert(Report $report): array
    {
        $result = [];

        foreach ($report as $item) {
            $result[] = [
                'abbreviation' => $item->racer->getAbbreviation(),
                'fullName' => $item->racer->getFullName(),
                'car' => $item->racer->getCar(),
                'bestTime' => self::getRacerBestTime($item->racer),
                'position' => $item->position,
            ];
        }

        return $result;
    }
}
