<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem\Storage\File\Exceptions;

class AbbreviationFileFormatException extends FileFormatException
{
    public function __construct(int $line)
    {
        $message = "Line $line does not match the required format in the abbreviation file";

        parent::__construct($message);
    }
}
