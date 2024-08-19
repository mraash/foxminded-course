<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report\Racers;

use DateTimeImmutable;
use Tests\TestCase;
use App\Packages\Report\Racers\Exceptions\TooLongBestTimeException;
use App\Packages\Report\Racers\Racer;

class RacerTest extends TestCase
{
    public function testGetters(): void
    {
        $racer = new Racer(
            'TEP',
            'Ted Popper',
            'MegaCar',
            new DateTimeImmutable('2020-00-00 00:00:00.000'),
            new DateTimeImmutable('2020-00-00 00:01:10.567')
        );

        $this->assertSame('TEP', $racer->getAbbreviation());
        $this->assertSame('Ted Popper', $racer->getFullName());
        $this->assertSame('MegaCar', $racer->getCar());
        $this->assertSame('TEP', $racer->getAbbreviation());
        $this->assertSame(70567, $racer->getBestTimeInMilliseconds());
    }

    public function testToLongBestTimeException(): void
    {
        $this->expectException(TooLongBestTimeException::class);

        new Racer(
            'TEP',
            'Ted Popper',
            'MegaCar',
            new DateTimeImmutable('2020-00-00 00:00:00.000'),
            new DateTimeImmutable('2020-01-00 00:01:10.567')
        );
    }
}
