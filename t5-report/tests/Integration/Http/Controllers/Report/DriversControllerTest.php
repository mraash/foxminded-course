<?php

declare(strict_types=1);

namespace Tests\Integration\Http\Controllers\Report;

use Tests\TestCase;
use App\Packages\Report\ViewData\ReportItemDto;

class DriversControllerTest extends TestCase
{
    public function testDriverListViewData(): void
    {
        $response = $this->get('/report/drivers');

        $racerListData = $response->viewData('racers');

        $this->assertContainsOnly(ReportItemDto::class, $racerListData);
    }

    public function testDriverViewData(): void
    {
        $response = $this->get('/report/drivers/aaa');

        $racerData = $response->viewData('racer');

        $this->assertInstanceOf(ReportItemDto::class, $racerData);
    }

    public function testNotFoundDriver(): void
    {
        $this->get('/report/drivers/asdfkjk')->assertStatus(404);
    }
}
