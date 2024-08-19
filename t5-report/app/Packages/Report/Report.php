<?php

declare(strict_types=1);

namespace App\Packages\Report;

use Iterator;
use App\Exceptions\DataDiscrepancyException;
use App\Exceptions\UndefinedKeyException;
use App\Packages\Report\Racers\RacerCollection;
use App\Packages\Report\Racers\Racer;

/**
 * Return of Report::build() method.
 *
 * @implements Iterator<int,ReportItem>
 */
class Report implements Iterator
{
    /** @var ReportItem[] */
    private array $items = [];
    private int $iteration = 0;

    public function __construct(RacerCollection $racers, RacerCollection $allRacers)
    {
        $sortedAllRacers = $allRacers->copy();
        $sortedAllRacers->sortByBestTime();

        foreach ($racers as $racer) {
            $position = self::getRacerPosition($racer, $sortedAllRacers);
            $this->items[] = new ReportItem($position, $racer);
        }
    }

    /**
     * @return Racer[]
     */
    public function toArrayOfRacers(): array
    {
        $racers = [];

        foreach ($this->items as $item) {
            $racers[] = $item->racer;
        }

        return $racers;
    }

    /**
     * Get number of report items.
     */
    public function length(): int
    {
        return count($this->items);
    }

    /**
     * Get report item by index.
     */
    public function item(int $index): ReportItem
    {
        if (!isset($this->items[$index])) {
            throw new UndefinedKeyException($index);
        }

        return $this->items[$index];
    }

    /**
     * Return the current iteration element.
     *
     * Iterator method.
     */
    public function current(): ReportItem
    {
        return $this->items[$this->iteration];
    }

    /**
     * Return the key of the current iteration element.
     *
     * Iterator method.
     */
    public function key(): int
    {
        return $this->iteration;
    }

    /**
     * Move forward to iterations next element.
     *
     * Iterator method.
     */
    public function next(): void
    {
        $this->iteration++;
    }

    /**
     * Rewind the Iterator to the first element.
     *
     * Iterator method.
     */
    public function rewind(): void
    {
        $this->iteration = 0;
    }

    /**
     * Checks if current iteration position exists.
     *
     * Iterator method.
     */
    public function valid(): bool
    {
        return count($this->items) > $this->iteration;
    }

    private static function getRacerPosition(Racer $racer, RacerCollection $sortedAllRacers): int
    {
        foreach ($sortedAllRacers as $i => $sortedRacer) {
            if ($sortedRacer->getAbbreviation() === $racer->getAbbreviation()) {
                return $i + 1;
            }
        }

        return throw new DataDiscrepancyException();
    }
}
