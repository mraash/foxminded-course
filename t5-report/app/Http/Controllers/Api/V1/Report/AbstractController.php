<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Report;

use App\Http\Controllers\Api\AbstractController as BaseController;
use App\Packages\Report\Data\DbRacerProvider;
use App\Packages\Report\ReportBuilder;
use App\Packages\Report\ViewData\ReportToResourceConverter;

abstract class AbstractController extends BaseController
{
    protected ReportBuilder $reportBuilder;
    protected ReportToResourceConverter $reportToResourceConverter;

    public function __construct()
    {
        parent::__construct();

        $racerProvider = new DbRacerProvider();
        $racers = $racerProvider->provide();

        $this->reportBuilder = new ReportBuilder($racers);

        $this->reportToResourceConverter = new ReportToResourceConverter();
    }
}
