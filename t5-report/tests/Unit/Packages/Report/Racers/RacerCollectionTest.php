<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report\Racers;

use App\Exceptions\FreezenObjectActivityException;
use App\Exceptions\UndefinedIdException;
use App\Packages\Report\Racers\RacerCollection;
use DateTimeImmutable;
use Tests\TestCase;

class RacerCollectionTest extends TestCase
{
    private RacerCollection $collection;

    public function setUp(): void
    {
        $this->collection = new RacerCollection();

        $this->collection->add(
            'AAA',
            'Racer A',
            'Car A',
            new DateTimeImmutable('2022-01-01 00:00:00'),
            new DateTimeImmutable('2022-01-01 00:01:00')
        );

        $this->collection->add(
            'BBB',
            'Racer B',
            'Car B',
            new DateTimeImmutable('2022-01-01 00:00:00'),
            new DateTimeImmutable('2022-01-01 00:02:00')
        );

        $this->collection->add(
            'CCC',
            'Racer C',
            'Car C',
            new DateTimeImmutable('2022-01-01 00:00:00'),
            new DateTimeImmutable('2022-01-01 00:03:00')
        );
    }

    public function tearDown(): void
    {
        unset($this->collection);
    }

    public function testFindMethods(): void
    {
        $abbreviations = $this->collection->findByAbbreviation('AAA')->getAbbreviation();
        $this->assertSame('AAA', $abbreviations);

        $name = $this->collection->findByName('Racer B')->getFullName();
        $this->assertSame('Racer B', $name);
    }

    public function testUndefinedAbbreviationException(): void
    {
        $this->expectException(UndefinedIdException::class);
        $this->collection->findByAbbreviation('asodj');
    }

    public function testUndefinedNameException(): void
    {
        $this->expectException(UndefinedIdException::class);
        $this->collection->findByName('asodj');
    }

    public function testFreezing(): void
    {
        $this->collection->freeze();

        $this->expectException(FreezenObjectActivityException::class);

        $this->collection->add(
            'DDD',
            'Racer D',
            'Car D',
            new DateTimeImmutable('2022-01-01 00:00:00'),
            new DateTimeImmutable('2022-01-01 00:04:00')
        );
    }
}
