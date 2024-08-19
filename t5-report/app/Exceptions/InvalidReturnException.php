<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Exception for cases when function/method returns stange value.
 */
class InvalidReturnException extends Exception
{
    public function __construct()
    {
        $message = 'Method/function returned invalid value';

        parent::__construct($message);
    }
}
