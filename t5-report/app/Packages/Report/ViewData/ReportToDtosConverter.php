<?php

declare(strict_types=1);

namespace App\Packages\Report\ViewData;

use App\Packages\Report\Report;

class ReportToDtosConverter extends AbstractConverter
{
    /**
     * @return ReportItemDto[]
     */
    public function convert(Report $report): array
    {
        $result = [];

        foreach ($report as $item) {
            $result[] = new ReportItemDto(
                $item->position,
                $item->racer->getAbbreviation(),
                $item->racer->getFullName(),
                $item->racer->getCar(),
                self::getRacerBestTime($item->racer),
            );
        }

        return $result;
    }
}
