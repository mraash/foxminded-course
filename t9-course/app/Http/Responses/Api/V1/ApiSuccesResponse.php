<?php

declare(strict_types=1);

namespace App\Http\Responses\Api\V1;

use Illuminate\Http\Response;

class ApiSuccesResponse extends Response
{
    /**
     * @param array<mixed,mixed>|null $data
     */
    public function __construct(array $data = null)
    {
        $responseData = [
            'success' => true,
        ];

        if ($data !== null) {
            $responseData['data'] = $data;
        }

        parent::__construct($responseData, 200, [
            'Content-type' => 'application/json',
        ]);
    }
}
