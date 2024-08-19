<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Report;

use App\Exceptions\UndefinedIdException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Packages\Report\ReportBuildFilter;

class DriversController extends AbstractController
{
    public function single(Request $request, string $abbreviation): Response
    {
        try {
            $racerName = $this->reportBuilder
                ->racerCollection()
                ->findByAbbreviation(strtoupper($abbreviation))
                ->getFullName();
        } catch (UndefinedIdException) {
            return $this->responseWrapper->makeErrorResponse($request, "Undefined abbreviation '$abbreviation'", 404);
        }

        $filter = ReportBuildFilter::construct()->addAllowedName($racerName);

        $report = $this->reportBuilder->build($filter);
        $resource = $this->reportToResourceConverter->convert($report)[0];

        return $this->responseWrapper->makeSuccessResponse($request, $resource);
    }
}
