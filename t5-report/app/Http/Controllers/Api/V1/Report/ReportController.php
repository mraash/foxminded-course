<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Report;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Packages\Report\ReportBuildFilter;

class ReportController extends AbstractController
{
    public function index(Request $request): Response
    {
        $isDesc = $request->input('order') === 'desc';

        $filter = new ReportBuildFilter();

        if ($isDesc) {
            $filter->desc();
        }

        $report = $this->reportBuilder->build($filter);
        $resource = $this->reportToResourceConverter->convert($report);

        return $this->responseWrapper->makeSuccessResponse($request, $resource);
    }
}
