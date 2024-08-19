<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem\Storage\File;

use App\Exceptions\InvalidReturnException;
use App\Packages\Report\Data\FileSystem\Storage\File\Exceptions\AbbreviationFileFormatException;

class AbbreviationFile extends AbstractFile
{
    /**
     * @inheritdoc
     *
     * @return array<array<string,string>>  An array of arrays with keys:
     *   - abbreviation => (string)
     *   - fullName     => (string)
     *   - car          => (string)
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
        if (count(explode('_', $line)) !== 3) {
            throw new AbbreviationFileFormatException($lineNumber);
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

        if (count($splitted) !== 3) {
            throw new InvalidReturnException();
        }

        return [
            'abbreviation' => $splitted[0],
            'fullName'     => $splitted[1],
            'car'          => $splitted[2],
        ];
    }
}
