<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem\Storage\File;

use App\Exceptions\InvalidReturnException;
use App\Packages\Report\Data\FileSystem\Storage\File\Exceptions\TimeFileFormatException;

class TimeFile extends AbstractFile
{
    /**
     * @inheritdoc
     *
     * @return array<array<string,string>>  An array of arrays with keys:
     *   - abbreviation => (string)
     *   - date         => (string)
     *   - time         =>  (string)
     */
    public function getData(): array
    {
        return parent::getData();
    }

    /**
     * @inheritdoc
     */
    protected function validateLine(string $line, int $lineNumber): void
    {
        if (!preg_match('/^[A-Z]{3}\d\d\d\d-\d\d-\d\d_\d\d:\d\d:\d\d.\d\d\d$/', $line)) {
            throw new TimeFileFormatException($lineNumber);
        }
    }

    /**
     * @inheritdoc
     *
     * @return array<string,string>
     */
    protected function convertLineToData(string $line): array
    {
        $splitted = explode('_', $line);

        if (count($splitted) !== 2) {
            throw new InvalidReturnException();
        }

        $abbreviation = substr($splitted[0], 0, 3);
        $date = substr($splitted[0], 3);
        $time = $splitted[1];

        return [
            'abbreviation' => $abbreviation,
            'date'         => $date,
            'time'         => $time,
        ];
    }
}
