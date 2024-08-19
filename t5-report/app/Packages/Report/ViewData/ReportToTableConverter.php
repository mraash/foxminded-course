<?php

declare(strict_types=1);

namespace App\Packages\Report\ViewData;

use App\Packages\Report\Report;

/**
 * Class that converts Report object to simple array.
 */
class ReportToTableConverter extends AbstractConverter
{
    /**
     * @return array<array<string>>
     */
    public function convert(Report $report): array
    {
        $result = [];

        foreach ($report as $i => $item) {
            $row = [
                $i + 1 . '.',
                $item->racer->getFullName(),
                $item->racer->getCar(),
                self::getRacerBestTime($item->racer),
            ];

            $result[] = $row;
        }

        return $result;
    }

    /**
     * Conver one racer.
     *
     * @return array<array<string>>
     */
    public function convertSingle(Report $report): array
    {
        if ($report->length() === 0) {
            return [];
        }

        return [
            [
                $report->item(0)->racer->getFullName(),
                $report->item(0)->racer->getCar(),
                self::getRacerBestTime($report->item(0)->racer),
                (string)$report->item(0)->position
            ]
        ];
    }
}
