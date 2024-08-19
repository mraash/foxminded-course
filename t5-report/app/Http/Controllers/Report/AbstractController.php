<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Packages\Report\Data\DbRacerProvider;
use App\Packages\Report\ReportBuilder;
use App\Packages\Report\ViewData\ReportToDtosConverter;

abstract class AbstractController extends Controller
{
    protected ReportBuilder $reportBuilder;
    protected ReportToDtosConverter $reportToDtosConverter;

    public function __construct()
    {
        $racerProvider = new DbRacerProvider();
        $racers = $racerProvider->provide();

        $this->reportBuilder = new ReportBuilder($racers);

        $this->reportToDtosConverter = new ReportToDtosConverter();
    }
}
