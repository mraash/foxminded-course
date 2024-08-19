<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Feature\TestCase;
use App\Domain\Models\Group;

class GroupsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        DB::table('groups')->insert([
            ['name' => 'A'],
            ['name' => 'B'],
        ]);

        $response = $this->get('/groups');
        $response->assertViewHas('groups');

        $groups = $response->viewData('groups');
        $this->assertContainsOnlyInstancesOf(Group::class, $groups);
        $this->assertCount(2, $groups);
        $this->assertEquals(1, $groups[0]->id);
        $this->assertEquals(2, $groups[1]->id);
    }
}
