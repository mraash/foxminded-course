<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Responses\Api\V1\ApiErrorResponse;
use App\Http\Responses\Api\V1\ApiSuccesResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Controller extends BaseController
{
    /**
     * @param array<string,mixed> $data
     */
    protected function makeSuccessResponse(array $data = null): ApiSuccesResponse
    {
        return new ApiSuccesResponse($data);
    }

    /**
     * @throws HttpResponseException
     */
    protected function throwResponseException(string $message = null, int $status = 500): never
    {
        throw new HttpResponseException(
            new ApiErrorResponse($message, $status)
        );
    }
}
