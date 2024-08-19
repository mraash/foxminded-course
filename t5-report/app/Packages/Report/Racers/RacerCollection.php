<?php

declare(strict_types=1);

namespace App\Packages\Report\Racers;

use Iterator;
use DateTimeImmutable;
use Ds\Vector;
use App\Exceptions\FreezenObjectActivityException;
use App\Exceptions\UndefinedIdException;
use App\Packages\Report\Racers\Racer;

/**
 * @implements Iterator<int,Racer>
 */
class RacerCollection implements Iterator
{
    /** @var Vector<Racer> */
    private Vector $racers;

    private int $iteration;

    private bool $canAddNewRacer = true;

    /**
     * @param Racer[] $racers  Start values.
     */
    public function __construct(iterable $racers = [])
    {
        $this->racers = new Vector($racers);
    }

    /**
     * Add Racer via primitives.
     */
    public function add(
        string $abbreviation,
        string $fullName,
        string $car,
        DateTimeImmutable $start,
        DateTimeImmutable $end
    ): void {
        $racer = new Racer($abbreviation, $fullName, $car, $start, $end);
        $this->addRacer($racer);
    }

    /**
     * Add Racer via object.
     */
    public function addRacer(Racer $racer): void
    {
        if (!$this->canAddNewRacer()) {
            throw new FreezenObjectActivityException();
        }

        $this->racers->push($racer);
    }

    /**
     * Find Racer by full name.
     *
     * @throws UndefinedIdException
     */
    public function findByName(string $name): Racer
    {
        foreach ($this->racers as $racer) {
            if ($racer->getFullName() === $name) {
                return $racer;
            }
        }

        throw new UndefinedIdException();
    }

    /**
     * Find Racer by abbreviation.
     *
     * @throws UndefinedIdException
     */
    public function findByAbbreviation(string $abbreviation): Racer
    {
        foreach ($this->racers as $racer) {
            if ($racer->getAbbreviation() === $abbreviation) {
                return $racer;
            }
        }

        throw new UndefinedIdException();
    }

    /**
     * Prevent adding new Racers.
     */
    public function freeze(): void
    {
        $this->canAddNewRacer = false;
    }

    /**
     * Whether the 'freeze' method was called.
     */
    private function canAddNewRacer(): bool
    {
        return $this->canAddNewRacer;
    }

    /**
     * Copy collection.
     */
    public function copy(): RacerCollection
    {
        return new RacerCollection($this->racers->copy()->toArray());
    }

    /**
     * Sort Racers by best time.
     */
    public function sortByBestTime(): void
    {
        $this->racers->sort(function (Racer $racerA, Racer $racerB): int {
            $millisecondsA = $racerA->getBestTimeInMilliseconds();
            $millisecondsB = $racerB->getBestTimeInMilliseconds();

            if ($millisecondsA < $millisecondsB) {
                return -1;
            }

            if ($millisecondsA > $millisecondsB) {
                return 1;
            }

            return 0;
        });
    }

    /**
     * Sorts the sequence in-place, based on an optional callable comparator.
     *
     * @param callable|null $callback  Accepts two values to be compared. Should return the result of a <=> b.
     */
    public function sort(callable|null $callback = null): void
    {
        $this->racers->sort($callback);
    }

    /**
     * Reverses the sequence in-place.
     */
    public function reverse(): void
    {
        $this->racers->reverse();
    }

    /**
     * @return Racer[]
     */
    public function toArray(): array
    {
        return $this->racers->toArray();
    }

    /**
     * Return the current iteration element.
     *
     * Iterator method.
     */
    public function current(): Racer
    {
        return $this->racers->get($this->iteration);
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
        return $this->racers->count() > $this->iteration;
    }
}
