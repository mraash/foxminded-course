<?php

declare(strict_types=1);

namespace App\Http\Controllers\Report;

use App\Exceptions\UndefinedIdException;
use App\Packages\Report\ReportBuildFilter;
use Illuminate\Contracts\View\View;

class DriversController extends AbstractController
{
    public function index(): View
    {
        $report = $this->reportBuilder->build();
        $reportView = $this->reportToDtosConverter->convert($report);

        return $this->makeView('pages.report.drivers', [
            'racers' => $reportView,
        ]);
    }

    public function single(string $abbreviation): View|never
    {
        try {
            $racerName = $this->reportBuilder
                ->racerCollection()
                ->findByAbbreviation(strtoupper($abbreviation))
                ->getFullName();
        } catch (UndefinedIdException) {
            return abort(404);
        }

        $filter = ReportBuildFilter::construct()->addAllowedName($racerName);

        $report = $this->reportBuilder->build($filter);

        if ($report->length() === 0) {
            return abort(404);
        }

        $racer = $this->reportToDtosConverter->convert($report)[0];

        return $this->makeView('pages.report.driver', [
            'racer' => $racer,
        ]);
    }
}
