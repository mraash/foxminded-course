<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem;

use App\Exceptions\UndefinedIdException;
use App\Exceptions\UndefinedKeyException;

/**
 * Abstract representation of file (start.log, end.log) data.
 */
class TimeLog
{
    /** @var TimeLogItem[] */
    private array $lines;

    /**
     * @param array<array<string,string>> $data  Array of associative arrays that shold have keys:
     *   - abbreviation => (string)
     *   - date         => (string)
     *   - time         => (string)
     */
    public function __construct(array $data)
    {
        $this->lines = [];

        foreach ($data as $dataLine) {
            $abbreviation = $dataLine['abbreviation'] or throw new UndefinedKeyException('abbreviation');
            $date         = $dataLine['date'] or throw new UndefinedKeyException('date');
            $time         = $dataLine['time'] or throw new UndefinedKeyException('time');

            $this->lines[] = new TimeLogItem($abbreviation, $date, $time);
        }
    }

    /**
     * Get number of lines.
     */
    public function getLength(): int
    {
        return count($this->lines);
    }

    /**
     * @return TimeLogItem[]
     */
    public function getAllLines(): array
    {
        return $this->lines;
    }

    /**
     * Has line with given abbreviation.
     */
    public function containsAbbreviation(string $abbreviation): bool
    {
        foreach ($this->lines as $line) {
            if ($line->abbreviation === $abbreviation) {
                return true;
            }
        }

        return false;
    }

    public function findByAbbreviation(string $abbreviation): TimeLogItem
    {
        foreach ($this->lines as $line) {
            if ($line->abbreviation === $abbreviation) {
                return $line;
            }
        }

        throw new UndefinedIdException();
    }
}
