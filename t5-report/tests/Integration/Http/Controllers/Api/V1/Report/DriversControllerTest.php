<?php

declare(strict_types=1);

namespace Tests\Integration\Http\Controllers\Api\V1\Report;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DriversControllerTest extends TestCase
{
    public function testSingleDriver(): void
    {
        $response = $this->get('/api/v1/report/drivers/aaa');

        $response->assertHeader('Content-type', 'application/json');
        $response->assertJson(function (AssertableJson $json) {
            $json
                ->where('response.success', true)
                ->has('response.data.abbreviation')
                ->has('response.data.fullName')
                ->has('response.data.car')
                ->has('response.data.bestTime')
                ->has('response.data.position')
            ;
        });
    }

    public function testUndefinedSingleDriver(): void
    {
        $response = $this->get('/api/v1/report/drivers/53qrteaf');

        $response->assertStatus(404);
        $response->assertHeader('Content-type', 'application/json');
        $response->assertJson(function (AssertableJson $json) {
            $json
                ->where('response.success', false)
                ->has('response.error')
            ;
        });
    }
}
