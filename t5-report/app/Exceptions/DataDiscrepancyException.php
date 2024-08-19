<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Exception for cases when you have two or more sources of truth, but they say different truth.
 */
class DataDiscrepancyException extends Exception
{
    public function __construct()
    {
        $message = 'There was discrepancy between some data';

        parent::__construct($message);
    }
}
