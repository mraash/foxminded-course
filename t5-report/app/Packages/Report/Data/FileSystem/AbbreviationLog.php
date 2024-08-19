<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem;

use App\Exceptions\UndefinedIdException;
use App\Exceptions\UndefinedKeyException;

/**
 * Abstract representation of file (abbreviations.txt) data.
 */
class AbbreviationLog
{
    /** @var AbbreviationLogItem[] */
    private array $lines;

    /**
     * @param array<array<string,string>> $data  Array of associative arrays that shold have keys:
     *   - abbreviation => (string)
     *   - fullName     => (string)
     *   - car          => (string)
     */
    public function __construct(array $data)
    {
        $this->lines = [];

        foreach ($data as $dataOfLine) {
            $abbreviation = $dataOfLine['abbreviation'] or throw new UndefinedKeyException('abbreviation');
            $name         = $dataOfLine['fullName'] or throw new UndefinedKeyException('fullName');
            $car          = $dataOfLine['car'] or throw new UndefinedKeyException('car');

            $this->lines[] = new AbbreviationLogItem($abbreviation, $name, $car);
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
     * @return AbbreviationLogItem[]
     */
    public function getAllLines(): array
    {
        return $this->lines;
    }

    /**
     * Has log object line with given abbreviation.
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

    public function findByAbbreviation(string $abbreviation): AbbreviationLogItem
    {
        foreach ($this->lines as $line) {
            if ($line->abbreviation === $abbreviation) {
                return $line;
            }
        }

        throw new UndefinedIdException();
    }
}
