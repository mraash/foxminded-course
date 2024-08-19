<?php

declare(strict_types=1);

namespace Tests\Integration\Packages\Report;

use DateTimeImmutable;
use Tests\TestCase;
use App\Packages\Report\Racers\RacerCollection;
use App\Packages\Report\ReportBuilder;
use App\Packages\Report\ReportBuildFilter;

class ReportBuilderTest extends TestCase
{
    private ReportBuilder $reportBuilder;

    public function setUp(): void
    {
        $collection = new RacerCollection();

        $collection->add(
            'AAA',
            'Racer A',
            'Car A',
            new DateTimeImmutable('2018-05-24 12:00:00.000'),
            new DateTimeImmutable('2018-05-24 12:04:02.979'),
        );

        $collection->add(
            'BBB',
            'Racer B',
            'Car B',
            new DateTimeImmutable('2018-05-24 12:00:00.000'),
            new DateTimeImmutable('2018-05-24 12:04:03.332'),
        );

        $collection->add(
            'CCC',
            'Racer C',
            'Car C',
            new DateTimeImmutable('2018-05-24 12:00:00.000'),
            new DateTimeImmutable('2018-05-24 12:04:04.666'),
        );

        $this->reportBuilder = new ReportBuilder($collection);
    }

    public function tearDown(): void
    {
        unset($this->reportBuilder);
    }

    public function testBuilding(): void
    {
        $racers = $this->reportBuilder->build()->toArrayOfRacers();

        $this->assertSame('AAA', $racers[0]->getAbbreviation());
        $this->assertSame('BBB', $racers[1]->getAbbreviation());
        $this->assertSame('CCC', $racers[2]->getAbbreviation());
    }

    public function testDescBuilding(): void
    {
        $racers = $this->reportBuilder->build(ReportBuildFilter::construct()->desc())->toArrayOfRacers();

        $this->assertSame('CCC', $racers[0]->getAbbreviation());
        $this->assertSame('BBB', $racers[1]->getAbbreviation());
        $this->assertSame('AAA', $racers[2]->getAbbreviation());
    }

    public function testBuildingWithAllowedNames(): void
    {
        $racers = $this->reportBuilder->build(
            ReportBuildFilter::construct()->addAllowedName('Racer A')->addAllowedName('Racer C')
        )->toArrayOfRacers();

        $this->assertSame('AAA', $racers[0]->getAbbreviation());
        $this->assertSame('CCC', $racers[1]->getAbbreviation());
    }
}
