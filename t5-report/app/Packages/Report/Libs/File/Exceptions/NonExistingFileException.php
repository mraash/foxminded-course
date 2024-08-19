<?php

declare(strict_types=1);

namespace App\Packages\Report\Libs\File\Exceptions;

use Exception;
use App\Packages\Report\Libs\File\File;

class NonExistingFileException extends Exception
{
    public function __construct(string $filePath)
    {
        parent::__construct("File \"{$filePath}\" doesn't exists.");
    }
}
