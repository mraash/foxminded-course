<?php

declare(strict_types=1);

namespace App\Packages\Report;

use App\Packages\Report\Racers\RacerCollection;

/**
 * Class that creates Report object.
 */
class ReportBuilder
{
    private RacerCollection $racerCollection;

    public function __construct(RacerCollection $racers)
    {
        $this->racerCollection = $racers->copy();
    }

    /**
     * Get RacerCollection.
     */
    public function racerCollection(): RacerCollection
    {
        return $this->racerCollection->copy();
    }

    /**
     * Main method.
     */
    public function build(ReportBuildFilter $filter = null): Report
    {
        $filter = $filter ?? new ReportBuildFilter();

        $racers = $this->racerCollection->copy();
        $racers->sortByBestTime();

        if ($filter->isDesc()) {
            $racers->reverse();
        }

        if ($filter->hasAllowedNames()) {
            $newRacers = new RacerCollection();

            foreach ($racers as $racer) {
                if ($filter->isNameInAllowedNames($racer->getFullName())) {
                    $newRacers->addRacer($racer);
                }
            }

            $racers = $newRacers;
        }

        return new Report($racers, $this->racerCollection);
    }
}
