<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report;

use DateTimeImmutable;
use Tests\TestCase;
use App\Packages\Report\Racers\RacerCollection;
use App\Packages\Report\Report;

class ReportTest extends TestCase
{
    private Report $report;

    public function setUp(): void
    {
        $racers = new RacerCollection();

        $racers->add(
            'AAA',
            'Racer A',
            'Car A',
            new DateTimeImmutable('2022-01-01 00:00:00'),
            new DateTimeImmutable('2022-01-01 00:00:10')
        );

        $racers->add(
            'BBB',
            'Racer B',
            'Car B',
            new DateTimeImmutable('2022-01-01 00:00:00'),
            new DateTimeImmutable('2022-01-01 00:00:20')
        );

        $racers->add(
            'CCC',
            'Racer C',
            'Car C',
            new DateTimeImmutable('2022-01-01 00:00:00'),
            new DateTimeImmutable('2022-01-01 00:00:30')
        );

        $this->report = new Report($racers, $racers);
    }

    public function tearDown(): void
    {
        unset($this->report);
    }

    public function testIteration(): void
    {
        $abbreviations = [
            0 => 'AAA',
            1 => 'BBB',
            2 => 'CCC',
        ];

        foreach ($this->report as $i => $item) {
            $this->assertSame($abbreviations[$i], $item->racer->getAbbreviation());
        }
    }
}
