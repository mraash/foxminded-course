<?php

declare(strict_types=1);

namespace Tests\Integration\Http\Controllers\Report;

use Tests\TestCase;
use App\Packages\Report\ViewData\ReportItemDto;

class ReportControllerTest extends TestCase
{
    public function testRedirect(): void
    {
        $this->get('/')->assertRedirect('/report');
    }

    public function testViewData(): void
    {
        $response = $this->get('/report');

        $reportData = $response->viewData('report');

        $this->assertContainsOnly(ReportItemDto::class, $reportData);
    }
}
