<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use InvalidArgumentException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Libs\ArrayConverter\ArrayConverterFactory;

class ResponseWrapper
{
    private ArrayConverterFactory $arrayConverterFactory;

    public function __construct()
    {
        $this->arrayConverterFactory = new ArrayConverterFactory();
    }

    /**
     * @param mixed[] $data
     */
    public function makeSuccessResponse(Request $request, array $data, int $status = 200): Response
    {
        $responseFormat = strval($request->input('format')) ?: 'json';
        $responseData = $this->makeSuccessData($data);

        try {
            $converter = $this->arrayConverterFactory->build($responseFormat);
        } catch (InvalidArgumentException) {
            /** @var Response */
            return response("Unknown format '$responseFormat'", $status, [
                'Content-Type' => 'text/plain',
            ]);
        }

        $responseBody = $converter->encode($responseData);

        /** @var Response */
        $response = response($responseBody, $status, [
            'Content-Type' => $responseFormat === 'xml' ? 'application/xml' : 'application/json',
        ]);

        return $response;
    }

    public function makeErrorResponse(Request $request, string $message, int $status = 500): Response
    {
        $responseFormat = $request->input('format') === 'xml' ? 'xml' : 'json';
        $responseData = $this->makeErrorData($message);

        try {
            $converter = $this->arrayConverterFactory->build($responseFormat);
        } catch (InvalidArgumentException) {
            /** @var Response */
            return response("Unknown format '$responseFormat'", $status, [
                'Content-Type' => 'text/plain',
            ]);
        }

        $responseBody = $converter->encode($responseData);

        /** @var Response */
        $response = response($responseBody, $status, [
            'Content-Type' => $responseFormat === 'xml' ? 'application/xml' : 'application/json',
        ]);

        return $response;
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    private function makeSuccessData(array $data): array
    {
        return [
            'response' => [
                'data' => $data,
                'success' => true,
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    private function makeErrorData(string $message): array
    {
        return [
            'response' => [
                'error' => $message,
                'success' => false,
            ]
        ];
    }
}
