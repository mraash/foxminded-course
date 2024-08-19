<?php

declare(strict_types=1);

namespace App\Http\Controllers\Report;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Packages\Report\ReportBuildFilter;

class ReportController extends AbstractController
{
    public function index(Request $request): View
    {
        $filter = new ReportBuildFilter();

        if ($request->input('order') === 'desc') {
            $filter->desc();
        }

        $report = $this->reportBuilder->build($filter);

        $reportView = $this->reportToDtosConverter->convert($report);

        return $this->makeView('pages.report.report', [
            'report' => $reportView
        ]);
    }
}
