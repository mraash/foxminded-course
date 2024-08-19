<?php

declare(strict_types=1);

namespace App\Http\Responses\Api\V1;

use Illuminate\Http\Response;

class ApiErrorResponse extends Response
{
    public function __construct(string $message = null, int $status = 500)
    {
        $responseData = [
            'success' => false,
        ];

        if ($message !== null) {
            $responseData['message'] = $message;
        }

        parent::__construct($responseData, $status, [
            'Content-type' => 'application/json',
        ]);
    }
}
