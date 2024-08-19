<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report\ViewData;

use DateTimeImmutable;
use Tests\TestCase;
use App\Packages\Report\Racers\RacerCollection;
use App\Packages\Report\Report;
use App\Packages\Report\ViewData\ReportToTableConverter;

class ReportToTableConverterTest extends TestCase
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

        $table = (new ReportToTableConverter())->convert($report);

        $this->assertEquals(['1.', 'A', 'Car A', '00:00:00.001'], $table[0]);
        $this->assertEquals(['2.', 'B', 'Car B', '00:00:00.002'], $table[1]);
        $this->assertEquals(['3.', 'C', 'Car C', '00:00:00.003'], $table[2]);
    }

    public function testSingleConversion(): void
    {
        $collection = new RacerCollection();

        $collection->add(
            'AAA',
            'A',
            'Car A',
            new DateTimeImmutable('2020-01-01 00:00:00.000'),
            new DateTimeImmutable('2020-01-01 00:00:00.001')
        );

        $report = new Report($collection, $collection);

        $table = (new ReportToTableConverter())->convertSingle($report);

        $this->assertCount(1, $table);
        $this->assertEquals(['A', 'Car A', '00:00:00.001', '1'], $table[0]);
    }

    public function testSingleConversionWithNoRacers(): void
    {
        $collection = new RacerCollection();

        $report = new Report($collection, $collection);

        $table = (new ReportToTableConverter())->convertSingle($report);

        $this->assertCount(0, $table);
    }

    public function testSingleConversionWithMoreThatOneRacer(): void
    {
        $collection = new RacerCollection();

        $collection->add(
            'AAA',
            'A',
            'Car A',
            new DateTimeImmutable('2020-01-01 00:00:00.000'),
            new DateTimeImmutable('2020-01-01 00:00:00.003')
        );

        $collection->add(
            'BBB',
            'B',
            'Car B',
            new DateTimeImmutable('2020-01-01 00:00:00.000'),
            new DateTimeImmutable('2020-01-01 00:00:00.002')
        );

        $report = new Report($collection, $collection);

        $table = (new ReportToTableConverter())->convertSingle($report);

        $this->assertCount(1, $table);
        $this->assertEquals(['A', 'Car A', '00:00:00.003', '2'], $table[0]);
    }
}
