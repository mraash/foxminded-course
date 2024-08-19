<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Feature\TestCase;

class GroupsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        DB::table('groups')->insert([
            ['name' => 'A'],
            ['name' => 'B'],
        ]);

        $response = $this->get('/api/v1/groups');
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('data.0.id', 1);
        $response->assertJsonPath('data.1.id', 2);
        $response->assertJsonMissingPath('data.2');
    }
}
