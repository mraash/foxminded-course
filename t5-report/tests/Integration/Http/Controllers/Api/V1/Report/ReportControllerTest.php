<?php

declare(strict_types=1);

namespace Tests\Integration\Http\Controllers\Api\V1\Report;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->get('api/v1/report');

        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json
                ->where('response.success', true)
                ->has('response.data.0.abbreviation')
                ->has('response.data.0.fullName')
                ->has('response.data.0.car')
                ->has('response.data.0.bestTime')
                ->has('response.data.0.position')
            ;
        });
    }
}
