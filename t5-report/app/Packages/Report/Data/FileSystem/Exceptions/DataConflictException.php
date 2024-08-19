<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem\Exceptions;

use Exception;

/**
 * One exception for all confilcts that can be between start.log end.log and abbreviations.txt data.
 */
class DataConflictException extends Exception
{
    public function __construct()
    {
        $message = 'There was some data conflict in report data';

        parent::__construct($message);
    }
}
