<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem\Storage\File;

use App\Exceptions\InvalidReturnException;
use App\Packages\Report\Libs\File\File;
use App\Packages\Report\Data\FileSystem\Storage\File\Exceptions\FileFormatException;

abstract class AbstractFile
{
    /** @var string[]  File lines */
    protected array $lines;

    public function __construct(File $file)
    {
        $content = self::removeEndingNewlines($file->getContent());
        $lines   = self::splitLines($content);

        foreach ($lines as $index => $line) {
            $this->validateLine($line, $index + 1);
        }

        $this->lines = $lines;
    }

    /**
     * Converts the contents of a file to array of associative arrays of lines.
     *
     * @return array<array<string,string>>
     */
    public function getData(): array
    {
        $result = [];

        foreach ($this->lines as $line) {
            array_push($result, $this->convertLineToData($line));
        }

        return $result;
    }

    /**
     * Throw exception if line is invalid.
     *
     * @throws FileFormatException
     */
    abstract protected function validateLine(string $line, int $lineNumber): void;

    /**
     * Convert one line of file to associative array.
     *
     * @return array<string,string>
     */
    abstract protected function convertLineToData(string $line): array;

    /**
     * Removes all newlines at the end of the given string.
     */
    private static function removeEndingNewlines(string $string): string
    {
        $result = preg_replace('/(\r\n|\r|\n)+$/', '', $string);

        if ($result === null) {
            throw new InvalidReturnException();
        }

        return $result;
    }

    /**
     * Breaks lines at newlines.
     *
     * @return string[]
     */
    private static function splitLines(string $string): array
    {
        $lines = preg_split('/(\r\n|\r|\n)/', $string);

        if ($lines === false) {
            throw new InvalidReturnException();
        }

        return $lines;
    }
}
