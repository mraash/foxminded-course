<?php

declare(strict_types=1);

namespace App\Packages\Report\Data;

use App\Models\Racer as RacerModel;
use App\Packages\Report\Racers\RacerCollection;

class DbRacerProvider implements RacerProviderInterface
{
    public function provide(): RacerCollection
    {
        $racers = RacerModel::all();

        $collection = new RacerCollection();

        foreach ($racers as $racer) {
            $collection->add(
                $racer->getAbbreviation(),
                $racer->getFullName(),
                $racer->getCar(),
                $racer->getBestTimeStart(),
                $racer->getBestTimeEnd(),
            );
        }

        return $collection;
    }
}
