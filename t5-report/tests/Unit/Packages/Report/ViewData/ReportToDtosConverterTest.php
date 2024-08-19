<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report\ViewData;

use DateTimeImmutable;
use Tests\TestCase;
use App\Packages\Report\Racers\RacerCollection;
use App\Packages\Report\Report;
use App\Packages\Report\ViewData\ReportItemDto;
use App\Packages\Report\ViewData\ReportToDtosConverter;

class ReportToDtosConverterTest extends TestCase
{
    public function testConversion(): void
    {
        $collection = new RacerCollection();

        $collection->add(
            'AAA',
            'A',
            'Car A',
            new DateTimeImmutable('2020-01-01 00:00:00.000'),
            new DateTimeImmutable('2020-01-01 00:00:00.001')
        );

        $collection->add(
            'BBB',
            'B',
            'Car B',
            new DateTimeImmutable('2020-01-01 00:00:00.000'),
            new DateTimeImmutable('2020-01-01 00:00:00.002')
        );

        $collection->add(
            'CCC',
            'C',
            'Car C',
            new DateTimeImmutable('2020-01-01 00:00:00.000'),
            new DateTimeImmutable('2020-01-01 00:00:00.003')
        );

        $report = new Report($collection, $collection);

        $reportItemds = (new ReportToDtosConverter())->convert($report);

        $this->assertInstanceOf(ReportItemDto::class, $reportItemds[0]);
        $this->assertInstanceOf(ReportItemDto::class, $reportItemds[1]);
        $this->assertInstanceOf(ReportItemDto::class, $reportItemds[2]);

        $this->assertSame('A', $reportItemds[0]->fullName);
        $this->assertSame('B', $reportItemds[1]->fullName);
        $this->assertSame('C', $reportItemds[2]->fullName);
    }
}
