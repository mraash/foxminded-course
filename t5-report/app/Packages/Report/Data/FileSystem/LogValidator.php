<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem;

use App\Packages\Report\Data\FileSystem\Exceptions\DataConflictException;

/**
 * Class that checks is there conflicts between log objects.
 */
class LogValidator
{
    /**
     * @throws DataConflictException
     */
    public function validate(TimeLog $start, TimeLog $end, AbbreviationLog $abbreviation): void
    {
        if (
            $start->getLength() !== $end->getLength()
            || $start->getLength() !== $abbreviation->getLength()
        ) {
            throw new DataConflictException();
        }

        foreach ($start->getAllLines() as $line) {
            if (
                !$end->containsAbbreviation($line->abbreviation)
                || !$abbreviation->containsAbbreviation($line->abbreviation)
            ) {
                throw new DataConflictException();
            }
        }
    }
}
