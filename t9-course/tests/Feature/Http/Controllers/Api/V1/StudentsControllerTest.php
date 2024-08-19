<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Feature\TestCase;

class StudentsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        DB::table('students')->insert([
            ['first_name' => 'A', 'last_name' => 'A'],
            ['first_name' => 'B', 'last_name' => 'B'],
        ]);

        $response = $this->get('/api/v1/students');
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('data.0.id', 1);
        $response->assertJsonPath('data.1.id', 2);
        $response->assertJsonMissingPath('data.2');
    }

    public function testSingle(): void
    {
        DB::table('students')->insert([
            ['first_name' => 'A', 'last_name' => 'A'],
        ]);

        $response = $this->get('api/v1/students/1');
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('data.id', 1);
    }

    public function testUndefinedSingle(): void
    {
        $response = $this->get('api/v1/students/9736');
        $response->assertStatus(404);
        $response->assertJsonPath('success', false);
    }

    public function testCreating(): void
    {
        $response = $this->post('api/v1/students', ['first-name' => 'C', 'last-name' => 'C']);
        $response->assertJsonPath('success', true);

        $this->assertDatabaseCount('students', 1);
    }

    public function testCreatingWithInvalidRequest(): void
    {
        $response = $this->post('api/v1/students', ['first-name' => 'C']);
        $response->assertJsonPath('success', false);

        $this->assertDatabaseCount('students', 0);
    }

    public function testDeleting(): void
    {
        DB::table('students')->insert([
            ['first_name' => 'A', 'last_name' => 'A'],
        ]);

        $response = $this->delete('api/v1/students/1');
        $response->assertJsonPath('success', true);

        $this->assertDatabaseCount('students', 0);
    }
}
