<?php

declare(strict_types=1);

namespace Tests\Integration\Packages\Report\Data;

use App\Packages\Report\Data\DbRacerProvider;
use Tests\TestCase;

class DbRacerProviderTest extends TestCase
{
    public function testProviding(): void
    {
        $provider = new DbRacerProvider();

        $racerCollection = $provider->provide();
        $racers = $racerCollection->toArray();

        $this->assertEquals('A Racer', $racers[0]->getFullName());
        $this->assertEquals('B Racer', $racers[1]->getFullName());
    }
}
